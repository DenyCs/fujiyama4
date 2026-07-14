<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a paginated, filterable list of activity logs.
     */
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by causer (admin user)
        if ($request->filled('causer_id')) {
            $query->where('causer_id', $request->causer_id);
        }

        // Filter by model type
        if ($request->filled('subject_type')) {
            $query->where('subject_type', $request->subject_type);
        }

        $logs = $query->paginate(20)->withQueryString();

        // Get distinct subject types for filter dropdown
        $subjectTypes = Activity::select('subject_type')
            ->distinct()
            ->whereNotNull('subject_type')
            ->pluck('subject_type')
            ->map(fn ($type) => [
                'value' => $type,
                'label' => class_basename($type),
            ]);

        // Get distinct causers for filter dropdown
        $causers = Activity::with('causer')
            ->select('causer_id')
            ->distinct()
            ->whereNotNull('causer_id')
            ->get()
            ->pluck('causer.name', 'causer_id')
            ->filter();

        return view('admin::activity-logs', compact('logs', 'subjectTypes', 'causers'));
    }

    /**
     * Show a single activity log detail (JSON).
     */
    public function show(Activity $activity)
    {
        $activity->load('causer');

        return response()->json([
            'id'          => $activity->id,
            'description' => $activity->description,
            'subject_type' => $activity->subject_type ? class_basename($activity->subject_type) : '-',
            'subject_id'  => $activity->subject_id,
            'causer_name' => $activity->causer?->name ?? 'System',
            'properties'  => $activity->properties,
            'created_at'  => $activity->created_at->format('d M Y H:i:s'),
        ]);
    }
}