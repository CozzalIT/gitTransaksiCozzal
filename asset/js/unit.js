                          function cek_detail_unit(n){
                              $.ajax({
                                type: 'POST',
                                url: '../../../proses/option_unit.php', 
                                data: {detail : n},
                                dataType: 'json',
                                beforeSend: function(e) {
                                  if(e && e.overrideMimeType) {
                                    e.overrideMimeType('application/json;charset=UTF-8');
                                  }
                                },
                                success: function(response){
                                    ret = response.ketersediaan;
                                    if (ret=='Ada') $('#hidenbtn').attr('href','detail_unit.php?detail_unit='+n);
                                    else $('#hidenbtn').attr('href','unit.php?info_unit='+n);
                                    var x = document.getElementById('hidenbtn');
                                    x.click();
                                    $('#hidenbtn').attr('href','#');
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                  alert(thrownError);
                                }
                              });
                          }
