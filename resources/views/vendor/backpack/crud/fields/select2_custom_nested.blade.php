<!-- based on select2_nested -->
@php
    $current_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ));

    function generateOption($item, $current_value, $level = 0)
    {
        $selected = ($current_value == $item->getKey()) ? 'selected' : '';
        return '<option value="'.$item->getKey().'" '.$selected.'>'. str_repeat("—", $level) . ' ' . $item->title . '</option>';
    }

    function generateTree($items, $current_value, $level = 0)
    {
        foreach ($items as $item) {
            if (count($item->children)) {
                echo generateOption($item, $current_value, $level);
                generateTree($item->children, $current_value, $level + 1);
            } else {
                echo generateOption($item, $current_value, $level);
            }
        }
    }

    $entity_model = $crud->getRelationModel($field['entity'], -1);

    $field['allows_null'] = $field['allows_null'] ?? $entity_model::isColumnNullable($field['name']);
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <select
        name="{{ $field['name'] }}"
        style="width: 100%"
        data-init-function="bpFieldInitSelect2NestedElement"
        @include('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_field'])
        >

        <option value="0" {{($current_value==0) ? 'selected' : ''}}>-</option>

        @if (isset($field['model']))
            @php
                $obj = new $field['model'];
                $first_level_items = $obj->where('parent_id', '0')->orWhere('parent_id', null)->orderBy('menu_order', 'ASC')->get();
                generateTree($first_level_items, $current_value);
            @endphp
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include select2 css-->
        @basset('packages/select2/dist/css/select2.min.css')
        @basset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css')
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        @basset('packages/select2/dist/js/select2.full.min.js')
        @if (app()->getLocale() !== 'en')
        @basset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js')
        @endif
        <script>
            function bpFieldInitSelect2NestedElement(element) {
                if (!element.hasClass("select2-hidden-accessible"))
                {
                    element.select2({
                        theme: "bootstrap"
                    });
                }
            }
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
