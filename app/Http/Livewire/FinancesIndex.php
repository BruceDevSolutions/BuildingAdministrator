<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FinancesIndex extends Component
{
    public function render()
    {
        $total_incomes = DB::table('incomes')
        ->select(DB::raw('SUM(value) as total'))
        ->get();

        $total_properties = Property::all()->count();

      
        $total_shop_properties = Property::where('property_type', Property::LOCAL_COMERCIAL)->count();

        $total_apartment_properties = Property::where('property_type', Property::DEPARTAMENTO)->count();


        $total_expenses = DB::table('expenses')
        ->select(DB::raw('SUM(value) as total'))
        ->get();


        $amount_available = $total_incomes[0]->total - $total_expenses[0]->total;


        $current_month_incomes = DB::table('incomes')->whereBetween('created_at',[Carbon::now()->subMonth(0)->startOfMonth()->toDateString(),Carbon::now()->subMonth(0)->endOfMonth()->toDateString()])
        ->select(DB::raw('SUM(value) as total'))
        ->get();
        
        $current_month_expenses = DB::table('expenses')->whereBetween('created_at',[Carbon::now()->subMonth(0)->startOfMonth()->toDateString(),Carbon::now()->subMonth(0)->endOfMonth()->toDateString()])
        ->select(DB::raw('SUM(value) as total'))
        ->get();

        /*  


        $tareas_pendientes = Mantenimiento::where('status', false)->count();

        $usuarios = User::count();
 */
        return view('livewire.finances-index', compact('total_incomes', 'total_properties', 'total_shop_properties', 'total_apartment_properties','amount_available', 'current_month_incomes', 'current_month_expenses'))->layoutData(['title' => 'Finanzas']);
    }
}
