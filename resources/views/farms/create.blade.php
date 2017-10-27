<h1>Farms: Create</h1>
<h3>Create a new Farm in this Environment.</h3>
<p></p>
<p>
    <form method="POST" action="{{ url('/farms') }}">
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <label style="display: inline-block; width: 84px;">Name: </label><span style="color: red;"> * </span><input type="text" name="name" /><br />
        <label style="display: inline-block; width: 100px;">Description: </label><input type="text" name="description" /><br />
        <label style="display: inline-block; width: 100px;">Launch Order: </label><input type="text" name="launchOrder" value="simultaneous" /><br />
        <label style="display: inline-block; width: 100px;">Timezone: </label><input type="text" name="timezone" value="Asia/Seoul" /><br />
        <button type="submit">Farm 생성</button>
    </form>
</p>
<p></p>
@isset($farm)
<h2>Response Body</h2>
<p>
    @php
    echo '<pre>'.json_encode($farm, JSON_PRETTY_PRINT).'</pre>';
    @endphp
</p>
<p></p>
@endisset
<p>
    <a href="/farms">List Farms</a>
</p>