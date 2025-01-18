@extends('nova::layout')

@section('content')
    <h1>Create Otchet</h1>
    <form method="POST" action="{{ route('otchet.store') }}">
        @csrf
        <!-- Выбор отдела -->
        <label for="departments">Select Departments:</label>
        <select id="departments" name="departments[]" multiple>
            <option value="commercial">Коммерческий отдел</option>
            <option value="service">Сервисная служба</option>
        </select>

        <!-- Поле для отображения выбранных полей -->
        <textarea id="fields" name="fields" readonly></textarea>

        <button type="submit">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departmentSelect = document.querySelector('#departments');
            const fieldsTextarea = document.querySelector('#fields');

            if (departmentSelect) {
                departmentSelect.addEventListener('change', function () {
                    const selectedDepartments = Array.from(departmentSelect.selectedOptions).map(option => option.value);

                    fetch('/nova-api/otchets/fields-options', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ departments: selectedDepartments })
                    })
                        .then(response => response.json())
                        .then(data => {
                            fieldsTextarea.value = JSON.stringify(data, null, 2);
                        });
                });
            }
        });
    </script>
@endsection
