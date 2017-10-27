<h1>Farms: List</h1>
<h3>List all the Farms available in this Environment.</h3>
<p></p>
<p>
    <form method="GET" action="{{ url('/farms/create') }}">
        <button type="submit">Create Farm</button>
    </form>
</p>
<p></p>
@isset($farms)
<h2>Response Body</h2>
<p>
    @php
    echo '<pre>'.json_encode($farms, JSON_PRETTY_PRINT).'</pre>';
    @endphp
</p>
@endisset