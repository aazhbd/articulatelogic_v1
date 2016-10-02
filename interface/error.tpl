<html>
<head>
    <title>Error Occured</title>
</head>

<body>
<p style="background:aqua;">
    Error:
    {foreach from=$errmsg item=msg}
        {$msg} <br />
    {/foreach}
</p>
</body>
</html>