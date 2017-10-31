<h1>Farms / Farm Roles: Create</h1>
<h3>Create a new Farm Role in a Farm.</h3>
<p></p>
<p>
    <form method="POST" action="{{ url('/farms') }}">
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <p>
            <h4>Farm</h4>
            <label style="display: inline-block; width: 84px;">Name: </label><span style="color: red;"> * </span><input type="text" name="name" /><br />
            <label style="display: inline-block; width: 100px;">Description: </label><input type="text" name="description" /><br />
            <label style="display: inline-block; width: 100px;">Launch Order: </label><input type="text" name="launchOrder" value="simultaneous" /><br />
            <label style="display: inline-block; width: 100px;">Timezone: </label><input type="text" name="timezone" value="Asia/Seoul" /><br />
        </p>
        <p></p>
        <p>
            <h4>Farm Role</h4>
            <label style="display: inline-block; width: 166px;">Cloud: </label><span>VMware vSphere</span><br />
            <label style="display: inline-block; width: 166px;">Location: </label><span>Service.DC</span><br />
            <label style="display: inline-block; width: 150px;">Alias: </label><span style="color: red;"> * </span><input type="text" name="alias" /><br />
            <label style="display: inline-block; width: 150px;">Instance Type: </label><span style="color: red;"> * </span><input type="text" name="instanceType" /><br />
            <label style="display: inline-block; width: 150px;">Folder: </label><span style="color: red;"> * </span><input type="text" name="folder" /><br />
            <label style="display: inline-block; width: 150px;">Compute Resource: </label><span style="color: red;"> * </span><input type="text" name="computeResource" /><br />
            <label style="display: inline-block; width: 150px;">Resource Pool: </label><span style="color: red;"> * </span><input type="text" name="resourcePool" /><br />
            <label style="display: inline-block; width: 150px;">Host: </label><span style="color: red;"> * </span><input type="text" name="hosts" /><br />
            <label style="display: inline-block; width: 150px;">Data Store: </label><span style="color: red;"> * </span><input type="text" name="dataStore" /><br />
            <label style="display: inline-block; width: 150px;">Network: </label><span style="color: red;"> * </span><input type="text" name="network" /><br />
        </p>
        <button type="submit">Farm / Farm Role 생성</button>
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