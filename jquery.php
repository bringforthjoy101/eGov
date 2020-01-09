
        <script type="text/javascript">
            $(document).ready(function(){
                $('#ministry').on('change',function(){
                    var ministry_ID = $(this).val();
                    if(ministry_ID){
                        $.ajax({
                            type:'POST',
                            url:'functions.php',
                            data:'ministry_id='+ministry_ID,
                            success:function(html){
                                $('#department').html(html);
                                //$('#city').html('<option value="">Select state first</option>'); 
                            }
                        }); 
                    }else{
                        $('#department').html('<option value="">Select Ministry First</option>');
                        //$('#city').html('<option value="">Select state first</option>'); 
                    }
                });
            });
        </script>
        