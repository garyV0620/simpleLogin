@props(['tableHead','datas'])
<div class="container">
    <table class="table table-success table-striped">
        <thead>
            <tr>
                @foreach ($tableHead as $header)
                <th>
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    @php
                        $keys = array_keys($data->toArray());
                    @endphp
                    
                    @foreach ($keys as $key)
                        <td>
                            {{ $data[$key] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>