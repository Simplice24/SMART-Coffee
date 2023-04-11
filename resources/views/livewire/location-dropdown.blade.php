<div>
<div>
<div class="row">
       {{ csrf_field() }}
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.Province') }}</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="provinces" style="height:46px;" name="province" wire:model="selectedProvince" required>
                                <option disabled selected>Select province</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->provincecode }}">{{ $province->provincename }}</option>
                                @endforeach
                            </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.district') }}</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="districts" style="height:46px;" name="district" required>
                                
                            </select>
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.sector') }}</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="sectors" style="height:46px;" name="sector" required>
                                
                            </select>
                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.cell') }}</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="cells" style="height:46px;" name="cell" required>
                                
                            </select>
                            </div>
                          </div>
                        </div>
                      </div>
</div>
</div>