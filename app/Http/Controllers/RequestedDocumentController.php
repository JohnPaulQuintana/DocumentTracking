<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\RequestedDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequestedDocumentController extends Controller
{
    public function showIncomingRequest(){
        $user_id = Auth::user()->id;
        // $documents = RequestedDocument::where('requestor',$user_id)
        // ->whereIn('forwarded_to',[1,$user_id])
        
        // ->get();
        $documents = DB::table('requested_documents')
            ->select('requested_documents.*', 'offices.id as office_id', 'offices.office_name', 'offices.office_abbrev', 'offices.office_head')
            ->join('offices', 'requested_documents.recieved_offices', '=', 'offices.id')
            ->where('requested_documents.requestor', $user_id)
            ->whereIn('requested_documents.forwarded_to', [1, $user_id])
            ->get();

        // Create a new collection with the desired structure
        $formattedDocuments = collect([]);

        foreach ($documents as $document) {
            $formattedDocument = [
                'document_id' => $document->id,
                'trk_id' => $document->trk_id,
                'requestor' => $document->requestor,
                'purpose' => $document->purpose,
                'documents' => $document->documents,
                'status' => $document->status,
                'created_at' => $document->created_at,
                'corporate_office' => [
                    'office_id' => $document->office_id,
                    'office_name' => $document->office_name,
                    'office_abbrev' => $document->office_abbrev,
                    'office_head' => $document->office_head,
                ],
            ];
        
            // Push the formatted document into the collection
            $formattedDocuments->push($formattedDocument);
            // dd($formattedDocuments);
        }

        //for selection request
        $allDepartments = Office::select('id', 'office_name', 'office_abbrev', 'office_head')->get();

        // Merge the two collections into a single collection
        // $combinedDocuments = $documents->concat($allDepartments);
       
        return view('departments.components.contents.requestDocument')->with(['documents'=>$formattedDocuments, 'departments'=>$allDepartments]);
    }
    public function showIncomingRequestAdmin(){
        $user_id = Auth::user()->id;
        // $documents = RequestedDocument::where('requestor',$user_id)
        // ->whereIn('forwarded_to',[1,$user_id])
        
        // ->get();
        $documents = DB::table('requested_documents')
            ->select('requested_documents.*', 'offices.id as office_id', 'offices.office_name', 'offices.office_abbrev', 'offices.office_head')
            ->join('offices', 'requested_documents.requestor', '=', 'offices.id')
            // ->where('requested_documents.requestor', 2)
            ->whereIn('requested_documents.forwarded_to', [1, $user_id])
            ->get();

            // dd($documents);
        // Create a new collection with the desired structure
        $formattedDocuments = collect([]);

        foreach ($documents as $document) {
            $formattedDocument = [
                'document_id' => $document->id,
                'trk_id' => $document->trk_id,
                'requestor' => $document->requestor,
                'purpose' => $document->purpose,
                'documents' => $document->documents,
                'status' => $document->status,
                'created_at' => $document->created_at,
                'corporate_office' => [
                    'office_id' => $document->office_id,
                    'office_name' => $document->office_name,
                    'office_abbrev' => $document->office_abbrev,
                    'office_head' => $document->office_head,
                ],
            ];
        
            // Push the formatted document into the collection
            $formattedDocuments->push($formattedDocument);
            // dd($formattedDocuments);
        }

        //for selection request
        $allDepartments = Office::select('id', 'office_name', 'office_abbrev', 'office_head')->get();

        // Merge the two collections into a single collection
        // $combinedDocuments = $documents->concat($allDepartments);
       
        return view('admin.components.contents.requestDocument')->with(['documents'=>$formattedDocuments, 'departments'=>$allDepartments]);
    }

    public function updateIncomingRequest(Request $request){
        // dd($request);
        $id = $request->input('id');
        // Update the 'status' field using the trk_id
        $affectedRows = RequestedDocument::where('id', $id)->update(['trk_id'=>$this->generateTRKID(),'status' => 'on-going']);
        
        // Build the success message
        $message = 'Successfully updated document!';

        // Prepare the toast notification data
        $notification = [
            'status' => 'success',
            'message' => $message,
        ];

        // Convert the notification to JSON
        $notificationJson = json_encode($notification);

        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);
    }
    
    public function create(Request $request)
    {
        // dd($request);
        // Validate the uploaded file
        $request->validate([
            'document' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
            'request-text' => 'required|max:255',
        ]);

        // Check if an image was uploaded
        if ($request->hasFile('document')) {
            $image = $request->file('document');

            $imageFolder = 'documents'; // You can change this folder name as needed

            // Store the uploaded image with a unique name
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($imageFolder . '/' .$imageName, file_get_contents($image));

            // Create a new RequestedDocument instance with default values
            $documentRequest = new RequestedDocument([
                // 'trk_id' => $this->generateTRKID(),
                'requestor' => auth()->user()->id, // Assuming you want to associate with the logged-in user
                'forwarded_to' => 1, // administrator
                'purpose' => $request->input('request-text'),
                'recieved_offices' => 1,//administrator
                'documents' => $imageName,
                'status' => 'pending', // Set the default status
            ]);

            $documentRequest->save();

             // Create a new RequestedDocument instance with default values
            $documentLogs = new Log([
                'requested_document_id' => $documentRequest->id,
                'forwarded_to' => $documentRequest->forwarded_to, // Assuming you want to associate with the logged-in user
                'current_location' => $documentRequest->recieved_offices, // Set the default value for requested_to
                'notes' => 'default notes',
                'status' => $documentRequest->status, // Set the default status
            ]);

            $documentLogs->save();
            
            // Save the image timestamp in the database
            // $imageModel = new Image();
            // $imageModel->timestamp = $imageName;
            // $imageModel->save();

            // Build the success message
        $message = 'Successfully Submitted your documents!';

        // Prepare the toast notification data
        $notification = [
            'status' => 'success',
            'message' => $message,
        ];

        // Convert the notification to JSON
        $notificationJson = json_encode($notification);

        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);

        }
        // Prepare the toast notification data
        $notification = [
            'status' => 'warning',
            'message' => 'Documents not submitted successfully!',
        ];
         // Convert the notification to JSON
         $notificationJson = json_encode($notification);
        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);

        // Create a new RequestedDocument instance with default values
        // $documentRequest = new RequestedDocument([
        //     'trk_id' => $this->generateTRKID(),
        //     'requested_by' => auth()->user()->id, // Assuming you want to associate with the logged-in user
        //     'requested_to' => 1, // Set the default value for requested_to
        //     'description' => $request->input('request-text'),
        //     'status' => 'forwarded', // Set the default status
        // ]);

        // Create a new RequestedDocument instance with default values
        // $documentLogs = new Log([
        //     'trk_id' => $documentRequest->trk_id,
        //     'requested_by' => $documentRequest->requested_by, // Assuming you want to associate with the logged-in user
        //     'requested_to' => $documentRequest->requested_to, // Set the default value for requested_to
        //     'description' => $documentRequest->description,
        //     'status' => $documentRequest->status, // Set the default status
        // ]);

        // Save the document to the database
        // $documentRequest->save();
        // $documentLogs->save();

        // $logs = Log::where('requested_by', Auth::user()->id)->get();
        // Format the created_at timestamps as "year-month-day"
        // $logs = $logs->map(function ($log) {
        //     $log->formatted_created_at = $log->created_at->format('Y-m-d');
        //     return $log;
        // });

        // Optionally, you can return a response here (e.g., success message or redirect)
        // return redirect()->back();
    }

    public function update(Request $request){
        // dd($request);
         // Parse the trk_id
        $trkId = $request->input('trk_id');
        $department_id = $request->input('department_id');
        // Update the 'status' field using the trk_id
        $affectedRows = RequestedDocument::where('trk_id', $trkId)->update(['status' =>'on-going']);

        if ($affectedRows > 0) {
            // Fetch the updated RequestedDocument record
            $documentRequest = RequestedDocument::where('trk_id', $trkId)->first();
            // Create a new RequestedDocument instance with default values
            $documentLogs = new Log([
                'trk_id' => $documentRequest->trk_id,
                'requested_by' => $documentRequest->requested_by, // Assuming you want to associate with the logged-in user
                'requested_to' => $department_id, // Set the default value for requested_to
                'description' => $documentRequest->description,
                'status' => $documentRequest->status, // Set the default status
            ]);
            $documentLogs->save();

            return response()->json(['message' => 'Status updated successfully']);
             
        } else {
            return response()->json(['message' => 'Document request not found'], 404);
        }

    }

    public function generateTRKID(){
         // Generate a unique ID with "TRK-" and 6 random digits
         $uniqueId = 'TRK-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
         return $uniqueId;
    }
    
}
