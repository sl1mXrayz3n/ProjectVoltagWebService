@if (is_array($value))
    <table>
        <tbody>
        @foreach($value as $key => $val)
            <tr>
                <td>{{ ucfirst($key) }}</td>
                <td>{{ $val }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <!-- Дополнительная обработка, если $value не является массивом -->
@endif
