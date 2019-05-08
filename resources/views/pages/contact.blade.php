<!-- Form Started -->
@extends('layouts.mainLayout.main_layout')

@section('content')

<div class="container form-top">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
            <div class="panel panel-danger">
                <div class="panel-body">
                    <form id="reused_form">
                        <div class="form-group">
                            <label><i class="fa fa-user" aria-hidden="true"></i> Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-comment" aria-hidden="true"></i> Message</label>
                            <textarea rows="3" name="message" class="form-control" placeholder="Type Your Message"></textarea>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-raised btn-block btn-danger">Post →</button>
                        </div>
                    </form>
                    <div id="error_message" style="width:100%; height:100%; display:none; ">
                        <h4>Error</h4>
                        Sorry there was an error sending your form.
                    </div>
                    <div id="success_message" style="width:100%; height:100%; display:none; ">
                        <h2>Success! Your Message was Sent Successfully.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        function after_form_submitted(data)
        {
            if(data.result == 'success')
            {
                $('form#reused_form').hide();
                $('#success_message').show();
                $('#error_message').hide();
            }
            else
            {
                $('#error_message').append('<ul></ul>');

                jQuery.each(data.errors,function(key,val)
                {
                    $('#error_message ul').append('<li>'+key+':'+val+'</li>');
                });
                $('#success_message').hide();
                $('#error_message').show();

                //reverse the response on the button
                $('button[type="button"]', $form).each(function()
                {
                    $btn = $(this);
                    label = $btn.prop('orig_label');
                    if(label)
                    {
                        $btn.prop('type','submit' );
                        $btn.text(label);
                        $btn.prop('orig_label','');
                    }
                });

            }//else
        }

        $('#reused_form').submit(function(e)
        {
            e.preventDefault();

            $form = $(this);
            //show some response on the button
            $('button[type="submit"]', $form).each(function()
            {
                $btn = $(this);
                $btn.prop('type','button' );
                $btn.prop('orig_label',$btn.text());
                $btn.text('Sending ...');
            });


            $.ajax({
                type: "POST",
                url: 'handler.php',
                data: $form.serialize(),
                success: after_form_submitted,
                dataType: 'json'
            });

        });
    });
</script>
<!-- Form Ended -->

@endsection