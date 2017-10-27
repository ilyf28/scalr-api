<h1>Farms: Delete</h1>
<h3>Delete a Farm from this Environment.</h3>
<p></p>
<p>
    <form method="POST" action="{{ url('/farms') }}">
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="delete" />
        <label style="display: inline-block; width: 84px;">Farm ID: </label><span style="color: red;"> * </span><input type="text" name="farmId" /><br />
        <button type="submit">Farm 삭제</button>
    </form>
</p>
<p></p>
@isset($message)
<h2>Response</h2>
<p>
    @php
    echo '<h4>'.$message.'</h4>';
    @endphp
</p>
<p></p>
@endisset
<p>
    <a href="/farms">List Farms</a>
</p>