<div>
<div>
<div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.Province') }}</label>
                            <div class="col-sm-9">
                            <select class="form-control" style="height:46px;" name="province" wire:model="selectedProvince" required>
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
                            <input type="text" class="form-control" name="district" required />
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.sector') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sector" required />
                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('msg.cell') }}</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="cell" required />
                            </div>
                          </div>
                        </div>
                      </div>
</div>

</div>