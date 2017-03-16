<?php
echo '<div class="ui divider"></div>
      <p>Cidra.ga © 2015-' . date("Y") . '. All right reserved</p>';

if ((DEBUG === "DISPLAY") and $GLOBALS["fullLog"]!="")
    echo  '<div id="errorDialog" class="ui long modal">
              <i class="close icon"></i>
              <div class="header">
                Error(s) occured
              </div>
              <div>
                ' . $GLOBALS["fullLog"] . '
              </div>
              <div class="actions">
                <div class="ui black ok right labeled icon button">
                  <i class="checkmark icon"></i>
                  OK
                </div>
              </div>
            </div>';
    //now for the display
    echo "<script type=\"text/javascript\">
            $('#errorDialog.modal')
            .modal('setting', 'transition', 'scale')
            .modal('show');
          </script>";
    /*
            $('#errorDialog.modal').onApprove(function(){
                alert('sa');
            });
                */
$GLOBALS["fullLog"] = '';
fclose($GLOBALS["logfile"]);