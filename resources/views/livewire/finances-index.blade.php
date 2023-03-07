<x-card>
    <x-title title="Finanzas" class="mb-4" />

    <div class="grid grid-cols-4 gap-8">
            <x-finance-card title="Ingresos totales" :money="$total_incomes[0]->total" />

            <x-finance-card title="Ingresos este mes" :money="$current_month_incomes[0]->total" />

            <x-finance-card title="Gastos este mes" :money="$current_month_expenses[0]->total" />

            <x-finance-card title="Efectivo disponible" :money="$amount_available" />

            <x-finance-card title="Inmuebles registrados" :value="$total_properties" icon-type="house" />

            <x-finance-card title="Departamentos" :value="$total_apartment_properties" icon-type="house" />
          
            <x-finance-card title="Locales comerciales" :value="$total_shop_properties" icon-type="house" />
    </div>
      
</x-card>