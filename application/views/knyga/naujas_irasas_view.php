<!-- Naujas irasas i knyga -->
<div id="naujas_irasas" class="modal fade" tabindex="-3" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Naujas įrašas</h4>
            </div>
            <div class="modal-body">
                {{ suma }}
                <form class="form-horizontal form-bordered" action="">
                    <div class="alert alert-warning" v-if="errors.length">
                        <b>Praome pataisyti sekančias klaidas:</b>
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                    </div>
                    <fieldset>
                        <div class="form-group">
                            <label for="dokumento_numeris" class="col-md-2 control-label">Dok. numeris:</label>
                            <div class="col-md-10">
                                <input id="dokumento_numeris" name="dokumento_numeris" v-model="dokumento_numeris" type="text" class="form-control" placeholder= ""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data" class="control-label col-md-2">Data:</label>
                            <div class="col-md-10">
                                <div class="input-group date">
                                    <input type="date" id="data" name="data" class="form-control" v-model="data"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="organizacija" class="col-md-2 control-label">Organizacija</label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-11">
                                        <select id="organizacija" name="organizacija" v-model="organizacija" class="form-control">
                                            <option value="">Pasirinkite</option>
                                            <option is="option-item"
                                                    v-for="item in organizacijos"
                                                    v-bind:option="item">
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="#organizaciju_sarasas" role="button" class="btn btn-primary" data-toggle="modal">+</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dok_rusis" class="col-md-2 control-label">Dokumento rūšis:</label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-12">
                                        <select name="dok_rusis" id="naujas_irasas.dok_rusis" v-model="dok_rusis" class="form-control">
                                            <option value="">Pasirinkite</option>
                                            <option is="option-item"
                                                    v-for="item in dokumento_rusis"
                                                    v-bind:option="item">
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kiekis" class="col-md-2 control-label">Kiekis</label>
                            <div class="col-md-10">
                                <input name="kiekis" id="kiekis" v-model="kiekis" type="number" min="0" max="10000" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Mato vienetas</label>
                            <div class="col-md-10">
                                <div class="radio radio-info radio-info radio-inline">
                                    <input type="radio" value="1" name="mato_vnt" v-model="mato_vnt">
                                    <label> VIENETAI </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" value="2" name="mato_vnt" v-model="mato_vnt">
                                    <label> KILOGRAMAI </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" value="3" name="mato_vnt" v-model="mato_vnt">
                                    <label> TONOS </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" value="4" name="mato_vnt" v-model="mato_vnt">
                                    <label> LITRAI </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" value="5" name="mato_vnt" v-model="mato_vnt">
                                    <label> PORA </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Atsiskaitymas:</label>
                            <div class="col-md-10">
                                <div class="radio radio-info radio-info radio-inline">
                                    <input type="radio" value="1" name="atsiskaitymas" v-model="atsiskaitymas">
                                    <label> BANKAS </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" value="2" name="atsiskaitymas" v-model="atsiskaitymas">
                                    <label> KASA </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" value="3" name="atsiskaitymas" v-model="atsiskaitymas">
                                    <label> SKOLA </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="atsiskaitymo_data" class="control-label col-md-2">Atsisk. terminas:</label>
                            <div class="col-md-10">
                                <div class="input-group date">
                                    <input type="date" id="atsiskaitymo_data" name="atsiskaitymo_data" class="form-control" v-model="atsiskaitymo_data"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Suma:</label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-4">
                                        <label class="control-label">Be PVM:</label>
                                        <input type="text" name="suma_be_pvm" class="form-control" placeholder="Be PVM" v-model="be_pvm">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">PVM:</label>
                                        <input type="text" name="pvm_suma" class="form-control" placeholder="PVM" v-model="pvm">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Viso:</label>
                                        <input type="text" name="bendra_suma" class="form-control" placeholder="Bendra suma" v-model="bendra_suma">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pvm_kodas" class="col-md-2 control-label">PVM kodas:</label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-11">
                                        <select name="pvm_kodas" id="pvm_kodas" v-model="pvm_kodas" v-on:change="rastiPVM" class="form-control">
                                            <option value="">Pasirinkite</option>
                                            <option is="option-pvm"
                                                    v-for="item in pvm_kodai"
                                                    v-bind:option="item">
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="#pvm" role="button" class="btn btn-primary" data-toggle="modal">+</a>
                                    </div>
                                </div>
                                <div class="alert alert-info" v-if="pvm_info">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            {{ selectPVM.pavadinimas }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            PVM tarifas: <b>{{ selectPVM.tarifas }} %</b>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ selectPVM.pvz }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2"></label>
                            <div class="col-md-10 col-sm-10">
                                <button class="btn btn-block btn-outline btn-primary" type="button" v-on:click="irasyti_nauja_irasa">
                                    IŠSAUGOTI NAUJĄ ĮRAŠĄ
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>