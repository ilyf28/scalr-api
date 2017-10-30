<h1>Farms: List</h1>
<h3>List all the Farms available in this Environment.</h3>
<p></p>
<p>
    <form method="GET" action="{{ url('/farms/create') }}">
        <button type="submit">Create Farm</button>
    </form>
    <form method="GET" action="{{ url('/farms/delete') }}">
        <button type="submit">Delete Farm</button>
    </form>
</p>
<p></p>
@isset($farms)

<table style="width:100%">
    <tr>
        <th>Name</th>
        <th>Description</th> 
        <th>Status</th> 
        <th>Owner</th>
        <th>Actions</th>
    </tr>
@foreach ($farms->data as $farm)
    <tr>
        <td>{{ $farm->name }}</td>
        <td>{{ $farm->description }}</td>
        <td>{{ $farm->status }}</td>
        <td>{{ $farm->owner->email }}</td>
        <td>
            @if ($farm->status === 'terminated')
            <a href="{{ url('/farms/'.$farm->id.'/launch') }}">launch</a>
            @elseif ($farm->status === 'running')
            <a href="{{ url('/farms/'.$farm->id.'/terminate') }}">terminate</a>
            @endif
        </td>
    </tr>
@endforeach

<p></p>
<h2>Response Body</h2>
<p>
    @php
    echo '<pre>'.json_encode($farms, JSON_PRETTY_PRINT).'</pre>';
    @endphp
</p>
@endisset