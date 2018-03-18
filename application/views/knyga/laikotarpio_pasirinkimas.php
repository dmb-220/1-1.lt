<!-- Laikotarpio pasirinkimas  -->
<div id="laikotarpis" class="modal fade" role="dialog" style="z-index: 1400;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Laikotarpis</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/knyga" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Ūkininkas</label>
                            <div class="col-md-6">
                                <?php echo form_error('ukininko_vardas');
                                if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                    <select name="ukininko_vardas" class="form-control">
                                        <option value="">Pasirinkite...</option>
                                        <?php
                                        foreach ($this->main_model->info['ukininkai'] as $row) {
                                            echo "<option value='$row[valdos_nr]'>";
                                            echo $row['vardas'];
                                            echo " ";
                                            echo $row['pavarde'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }else{
                                    echo '<select name="ukininko_vardas" class="form-control" disabled>';
                                    echo'<option value='.$dt['nr'].' selected="selected">'.$dt['vardas'].' '.$dt['pavarde'].'</option>';
                                    echo'</select>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Metai</label>
                            <div class="col-md-6">
                                <?php echo form_error('metai'); ?>
                                <select name="metai" class="form-control">
                                    <option value="2016">2016</option>
                                    <option value="2017" selected="selected">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Menesis</label>
                            <div class="col-md-6">
                                <?php echo form_error('menesis'); ?>
                                <select name="menesis" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    for($i=0; $i<count($men); $i++) {
                                        $mm = $i+1;
                                        echo"<option value=".$mm.">";
                                        echo $men[$i];
                                        echo"</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4"></label>
                            <div class="col-md-6 col-sm-6">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> PASIRINKTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>