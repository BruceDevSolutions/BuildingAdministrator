<x-card>
    <x-title title="Registrar ingreso" class="mb-4" />

    <x-forms.select error-name="type_id" label="Tipo de ingreso:" wire:model="type_id">
        <option value="null" selected>--Selecciona un tipo de ingreso--</option>
        <option value="1">Multas</option>
        <option value="2">Cuotas extraordinarias</option>
        <option value="3">Pago de expensas</option>
    </x-forms.select>

    <div>
        @if($type_id)
            <form wire:submit.prevent='save'>
                <div class="flex flex-col space-y-4">
                    <x-forms.input 
                        wire:model="concept"
                        label="Concepto"
                        type="text"
                        placeholder="Ingresa el concepto de la deuda"
                        error-name="concept"
                    />
        
                    <x-forms.textarea 
                        wire:model="details"
                        label="Detalles adicionales"
                        rows="3"
                        placeholder="Ingresa detalles adicionales"
                        error-name="details"
                    />
        
                    <x-forms.input 
                        wire:model="value"
                        label="Monto"
                        type="Number"
                        placeholder="Ingresa un monto"
                        error-name="value"
                        :disabled="$fine_selected || $property_expense_id ?? false"
                    />
        
                    <x-forms.input 
                        wire:model="date"
                        label="Fecha de pago"
                        type="date"
                        error-name="date"
                    />
        
                    <x-forms.input 
                        wire:model="vaucher_path"
                        label="Comprobante"
                        type="file"
                        error-name="vaucher_path"
                    />
                    
                    {{-- Multas --}}
                    <div>
                        @if($type_id == 1)
                            <x-forms.select label="Inmueble" wire:model="property_fine_id">
                                <option value="null" selected>--Selecciona un inmueble--</option>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}" >{{ $property->code }}</option>
                                @endforeach
                            </x-forms.select>
                            @if($property_fines[0] ?? false)
                                <x-forms.select error-name="fine_selected" label="Selecciona una multa" wire:model="fine_selected">
                                    <option value="null" selected>--Selecciona una multa--</option>
                                    @foreach ($property_fines as $fine)
                                        <option value="{{ $fine->id }}" >{{ $fine->id }} -- {{ $fine->concept }}</option>
                                    @endforeach
                                </x-forms.select>
                            @else
                                <x-paragraph class="mt-4 text-sm">El inmueble seleccionado no tiene multas pendientes.</x-paragraph>
                            @endif
                        @endif
                    </div>

                    {{-- Cuotas extraordinarias --}}
                    <div>
                        @if($type_id == 2)
                            <x-forms.select label="Inmueble" wire:model="property_fee_id">
                                <option value="null" selected>--Selecciona un inmueble--</option>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}" >{{ $property->code }}</option>
                                @endforeach
                            </x-forms.select>
                            @if($property_fees[0] ?? false)
                                <x-forms.select error-name="fee_selected" label="Selecciona una cuota extraordinaria" wire:model="fee_selected">
                                    <option value="null" selected>--Selecciona una cuota extraordinaria--</option>
                                    @foreach ($property_fees as $fee)
                                        <option value="{{ $fee->id }}" >{{ $fee->id }} -- {{ $fee->concept }}</option>
                                    @endforeach
                                </x-forms.select>
                            @else
                                <x-paragraph class="mt-4 text-sm">El inmueble seleccionado no tiene cuotas extraordinarias pendientes.</x-paragraph>
                            @endif
                        @endif
                    </div>

                    {{-- Expensas --}}
                    <div>
                        @if($type_id == 3)
                            <x-forms.select label="Inmueble" wire:model="property_expense_id">
                                <option value="null" selected>--Selecciona un inmueble--</option>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}" >{{ $property->code }}</option>
                                @endforeach
                            </x-forms.select>
                            <x-forms.input 
                                wire:model="paid_up_to"
                                label="Pagado hasta:"
                                placeholder="Ingresa el concepto de la deuda"
                                error-name="paid_up_to"
                                value="{{ $paid_up_to }}" 
                                min="{{ $paid_up_to }}" 
                                type="month"
                            />
                            <x-forms.input 
                                wire:model="names"
                                label="Pagado por:"
                                type="text"
                                placeholder="Ingresa el nombre de la persona que realizó el pago"
                                error-name="names"
                            />
                        @endif
                    </div>
                    {{ $new_paid_month }}
                </div>
                <div class="mt-8 flex justify-end">
                    <x-button>
                        Registrar
                    </x-button>
                </div>
            </form>
        @endif

    </div>
    
    <x-notifications />

</x-card>