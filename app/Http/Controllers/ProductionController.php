<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PModel;
use App\Models\DailyPlan;
use App\Models\Contact;
use App\Models\FinancialYear;
use App\Models\DocOrder;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Dispatch;
use App\Models\DispatchDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ProductionController extends Controller
{
    public function index()
    {
        // Fetch all product models that exist at least once in order_details
        $p_models = DB::table('p_models')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('order_details')
                    ->whereRaw("CAST(order_details.item_code AS CHAR CHARACTER SET utf8mb4) = CAST(p_models.model_code AS CHAR CHARACTER SET utf8mb4)");
            })
            ->orderBy('p_models.order', 'asc')
            ->get();

        return view('logics.manufacture.production_report.production_report', compact('p_models'));
    }

    public function daily_plan()
    {
        // Fetch all product models that exist at least once in order_details
        $daily_plans = DailyPlan::orderBy('id', 'desc')->get();

        return view('logics.manufacture.production_report.daily_plan', compact('daily_plans'));
    }

    public function add_daily_plan(Request $request)
    {
        $model_code = $request->model_code;
        $plan_date = $request->planDate;
        $qty = $request->qty;

        $input['model_code'] = $model_code;
        $input['plan_date'] = date('Y-m-d', strtotime($plan_date));
        $input['qty'] = $qty;

        $datas = DailyPlan::create($input);

        if ($datas) {
            return redirect()->to('daily_plan')->with('success', 'Daily Plan Created!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }
    }
        
    public function update_daily_plan(Request $request)
    {
        // Validate input data
        $request->validate([
            'plan_id' => 'required|integer',
            'eplanDate' => 'required|date',
            'emodel_code' => 'required|string',
            'eqty' => 'required|integer|min:1',
        ]);

        try {
            // Update the daily_plans table
            DB::table('daily_plans')
                ->where('id', $request->plan_id)
                ->update([
                    'plan_date' => $request->eplanDate,
                    'model_code' => $request->emodel_code,
                    'qty' => $request->eqty,
                    'updated_at' => now(), // Laravel helper function to set current timestamp
                ]);

            // Redirect with success message
            return redirect()->back()->with('success', 'Daily plan updated successfully.');
        } catch (\Exception $e) {
            // Handle error and return failure message
            return redirect()->back()->with('error', 'Failed to update daily plan. ' . $e->getMessage());
        }
    }

    public function delete_daily_plan($id)
    {
        try {
            // Check if the record exists
            $dailyPlan = DB::table('daily_plans')->where('id', $id)->first();

            if (!$dailyPlan) {
                return redirect()->back()->with('error', 'Plan not found.');
            }

            // Delete the record
            DB::table('daily_plans')->where('id', $id)->delete();

            // Redirect with success message
            return redirect()->back()->with('success', 'Daily plan deleted successfully.');
        } catch (\Exception $e) {
            // Handle error and return failure message
            return redirect()->back()->with('error', 'Failed to delete daily plan. ' . $e->getMessage());
        }
    }

    public function production_requirement_report()
    {
        // Fetch all product models that exist at least once in daily_plan
        $p_models = DB::table('p_models')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('order_details')
                    ->whereRaw("CAST(order_details.item_code AS CHAR CHARACTER SET utf8mb4) = CAST(p_models.model_code AS CHAR CHARACTER SET utf8mb4)");
            })
            ->orderBy('p_models.order', 'asc')
            ->get();

        return view('logics.manufacture.production_report.production_requirement_report', compact('p_models'));
    }

    public function financialyear()
    {
        $financial_year_to = (date('m') > 3) ? date('y') +1 : date('y');
        $financial_year_from = $financial_year_to - 1;
        $financial_year= $financial_year_from.$financial_year_to;
        return $financial_year;
    }

}
