<!-- BEGIN: end -->    <br /><h2>{LANG.compulsory_end}</h2>    <div id="menuonbai">        <a title="{LANG.ques}" href="{URL_QUES}" class="menu1">{LANG.ques}</a>                <a title="{LANG.test}" href="{URL_TEST}" class="menu2">{LANG.test}</a>            <a title="{LANG.compulsory}" href="{URL_COMPULSORY}" class="menu3">{LANG.compulsory}</a>        </div><!-- END: end --><!-- BEGIN: main -->    <div id="menuonbai">        <a title="{LANG.ques}" href="{URL_QUES}" class="menu1">{LANG.ques}</a>                <a title="{LANG.test}" href="{URL_TEST}" class="menu2">{LANG.test}</a>            <a title="{LANG.compulsory}" href="{URL_COMPULSORY}" class="menu3">{LANG.compulsory}</a>        </div>    <h2 class="ques">{title}</h2>    <div class="bodyques">        {ques}    </div>        <form action="" method="post">    <table cellpadding="0" class="tableonbai" style="width: 100%; float: left">        <tr>            <td class="giua" style="width: 92px">{LANG.select_nas}</td>            <td style="text-align:center;border-left:1px gray solid;">{LANG.ans}&nbsp;</td>        </tr>        <tr>            <td class="giua" style="width: 92px">                <a href="{URL}&anwser=1" id="show" class="adelfile">{LANG.select} A</a>             </td>            <td class="test">                {anwsera}            </td>        </tr>        <tr>            <td class="giua" style="width: 92px">            <a href="{URL}&anwser=2" id="show" class="bdelfile">{LANG.select} B</a>            <td class="test">            {anwserb}            </td>        </tr>        <tr>            <td class="giua" style="width: 92px">            <a href="{URL}&anwser=3" id="show" class="cdelfile">{LANG.select} C</a>            <td class="test">            {anwserc}            </td>        </tr>        <tr>            <td class="giua" style="width: 92px">            <a href="{URL}&anwser=4" id="show" class="ddelfile">{LANG.select} D</a>            <td class="test">            {anwserd}            </td>        </tr>    </table>    </form>    <script type='text/javascript'>        $('a[class="adelfile"]').click(function(event)        {            event.preventDefault();            if (confirm("{LANG.confirm}"))            {                var href = $(this).attr('href');                $.ajax(                {                    type: 'POST',                    url: href,                    data: '',                    success: function(data)                    {                            if ( data == 1)                        {                            alert('{LANG.true_anwser}');                            window.location = '{NEXTURL}';                        }                        else alert('{LANG.false_anwser}');                                            }                });            }        });        $('a[class="bdelfile"]').click(function(event)        {            event.preventDefault();            if (confirm("{LANG.confirm}"))            {                var href = $(this).attr('href');                $.ajax(                {                    type: 'POST',                    url: href,                    data: '',                    success: function(data)                    {                            if ( data == 1)                        {                            alert('{LANG.true_anwser}');                            window.location = '{NEXTURL}';                        }                        else alert('{LANG.false_anwser}');                                            }                });            }        });        $('a[class="cdelfile"]').click(function(event)        {            event.preventDefault();            if (confirm("{LANG.confirm}"))            {                var href = $(this).attr('href');                $.ajax(                {                    type: 'POST',                    url: href,                    data: '',                    success: function(data)                    {                            if ( data == 1)                        {                            alert('{LANG.true_anwser}');                            window.location = '{NEXTURL}';                        }                        else alert('{LANG.false_anwser}');                                            }                });            }        });        $('a[class="ddelfile"]').click(function(event)        {            event.preventDefault();            if (confirm("{LANG.confirm}"))            {                var href = $(this).attr('href');                $.ajax(                {                    type: 'POST',                    url: href,                    data: '',                    success: function(data)                    {                            if ( data == 1)                        {                            alert('{LANG.true_anwser}');                            window.location = '{NEXTURL}';                        }                        else alert('{LANG.false_anwser}');                                            }                });            }        });</script><!-- END: main -->