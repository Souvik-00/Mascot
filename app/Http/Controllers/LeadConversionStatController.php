<?php // PHP opening tag so the interpreter treats this file as PHP code

namespace App\Http\Controllers; // Defines the namespace for the controller within the application

use App\Models\Lead; // Imports the Lead model so we can query available leads
use Illuminate\Http\Request; // Imports the Request class to access incoming form data
use App\Models\CrmPipelineStage; // Imports the pipeline stage model for dropdown values
use App\Models\LeadConversionStat; // Imports the LeadConversionStat model for database operations

class LeadConversionStatController extends Controller // Declares the controller class extending the base Controller
{
    /**
     * Display a listing of the lead conversion records.
     */
    public function index() // Handles the request to list lead conversion stats
    {
        $stats = LeadConversionStat::with(['lead', 'pipelineStage']) // Eager load related lead and stage details
                    ->orderBy('date', 'desc') // Sort so the newest conversion entries appear first
                    ->paginate(10); // Paginate the result set to show ten entries per page

        return view('lead_conversion_stats.index', compact('stats')); // Render the index view with the prepared data
    } // End of index action

    /**
     * Show the form for creating a new record.
     */
    public function create() // Handles showing the creation form
    {
        $leads = Lead::orderBy('name', 'asc')->get(); // Retrieve all leads sorted alphabetically for the select menu
        $stages = CrmPipelineStage::orderBy('crm_pipeline_stages', 'asc')->get(); // Retrieve all pipeline stages alphabetically

        return view('lead_conversion_stats.create', compact('leads', 'stages')); // Display the create form with lead and stage options
    } // End of create action

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request) // Accepts the submitted form and persists a new record
    {
        $validated = $request->validate([ // Validate incoming fields to ensure integrity
            'leads_id' => 'required|exists:leads_tbl,id', // Lead must be selected and exist in the leads table
            'date' => 'required|date', // Conversion date must be provided in a valid format
            'crm_pipeline_stages_id' => 'required|exists:crm_pipeline_stages_tbl,id', // Stage must exist in the pipeline stages table
            'comments' => 'required|string', // Comments field must be a non-empty string
        ]); // End of validation rules

        LeadConversionStat::create($validated); // Persist the validated data as a new conversion record

        return redirect()->route('lead_conversion_stats.index') // Redirect back to the list after storing the record
            ->with('success', 'Lead conversion record added successfully.'); // Flash a success message for the user
    } // End of store action

    /**
     * Display the specified record.
     */
    public function show(LeadConversionStat $lead_conversion_stat) // Displays a single conversion entry
    {
        $lead_conversion_stat->load(['lead', 'pipelineStage']); // Ensure related lead and stage data are loaded
        return view('lead_conversion_stats.show', compact('lead_conversion_stat')); // Render the detail view with the conversion record
    } // End of show action

    /**
     * Show the form for editing the specified record.
     */
    public function edit(LeadConversionStat $lead_conversion_stat) // Shows the edit form for a specific conversion
    {   // Opening brace for edit method

        
        $leads = Lead::orderBy('name', 'asc')->get(); // Load available leads for selection in the form
        $stages = CrmPipelineStage::orderBy('crm_pipeline_stages', 'asc')->get(); // Load pipeline stages for the dropdown

        session(["crm_pipeline_stages_id" => $lead_conversion_stat->crm_pipeline_stages_id]); //created a new session variable crm_pipeline_stages_id and pushed the current pipeline stage id to it
        // dd($crm_pipeline_stages_id);

        return view('lead_conversion_stats.edit', compact('lead_conversion_stat', 'leads', 'stages')); // Return the edit view with data needed to populate fields
    } // End of edit action

    /**
     * Update the specified record in storage.
     */
    public function update(Request $request, LeadConversionStat $lead_conversion_stat) // Receives the edit submission for a conversion
    {
        /*checking if crm pipeline stages is changed.
        If crm pipeline stages is changed we update the same entry
        If crm pipeline stages is not changed we insert a new entry
        */
        if(session('crm_pipeline_stages_id') == $request->crm_pipeline_stages_id) {
            $validated = $request->validate([ // Validate the incoming data before saving
            'leads_id' => 'required|exists:leads_tbl,id', // Ensure the chosen lead exists
            'date' => 'required|date', // Require a valid date for the conversion update
            'crm_pipeline_stages_id' => 'required|exists:crm_pipeline_stages_tbl,id', // Ensure the pipeline stage exists
            'comments' => 'required|string', // Require descriptive comments about the change
        ]); // End of validation configuration

        $lead_conversion_stat->update($validated); // Apply the validated changes to the existing record

        return redirect()->route('lead_conversion_stats.index') // Redirect back to the list of conversion stats
            ->with('success', 'Lead conversion record updated successfully.'); // Notify the user of the successful update
        
        }else {
            $validated = $request->validate([ // Validate incoming fields to ensure integrity
            'leads_id' => 'required|exists:leads_tbl,id', // Lead must be selected and exist in the leads table
            'date' => 'required|date', // Conversion date must be provided in a valid format
            'crm_pipeline_stages_id' => 'required|exists:crm_pipeline_stages_tbl,id', // Stage must exist in the pipeline stages table
            'comments' => 'required|string', // Comments field must be a non-empty string
        ]); // End of validation rules

        LeadConversionStat::create($validated); // Persist the validated data as a new conversion record

        return redirect()->route('lead_conversion_stats.index') // Redirect back to the list after storing the record
            ->with('success', 'Lead conversion record added successfully.'); // Flash a success message for the user
        }
        
    } // End of update action

    /**
     * Remove the specified record from storage.
     */
    public function destroy(LeadConversionStat $lead_conversion_stat) // Handles deletion of a conversion record
    {
        $lead_conversion_stat->delete(); // Delete the selected conversion entry from the database

        return redirect()->route('lead_conversion_stats.index') // After deletion, return to the list view
            ->with('success', 'Lead conversion record deleted successfully.'); // Inform the user that the record was deleted
    } // End of destroy action
} // Closing brace for the LeadConversionStatController class
