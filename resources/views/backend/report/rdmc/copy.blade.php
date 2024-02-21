<fieldset>
    <div class="row" hidden>
        <div class="col-sm-3">
            <div class="form-group">
                <label>ProgramID</label>
                {{-- Route::input('name'); --}}
                <input type="text" class="form-control" value="<?= substr(md5(microtime()), 0, 10) ?>" readonly
                    placeholder="Enter code" name="programID">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Fund Code</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#</span>
                    </div>
                    <input type="text" class="form-control" id="fund_code" placeholder="Enter code" name="fund_code">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Status</label>
                <select name="program_status" id="" class="form-control custom-select">
                    <option value="" selected disabled>--Select Status--</option>
                    <option value="New">New</option>
                    <option value="On-going">On-going</option>
                    <option value="Terminated">Terminated</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Category</label>
                <select name="program_category" id="" class="form-control custom-select">
                    <option value="" selected disabled>--Select Category--</option>
                    <option value="Research Category">Research Category</option>
                    <option value="Development Category">Development Category</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Program Title</label>
                <textarea name="program_title" id="" cols="30" rows="5" style="resize: none;" class="form-control"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label>Funding Agency</label>
                <select class="form-control agency" name="funding_agency" id="">
                    <option></option>
                    @foreach ($agency as $key)
                        <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                            ({{ $key->abbrev }})
                            </b></option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Coordination Fund</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">PHP</span>
                    </div>
                    <input type="text" name="coordination_fund" class="form-control" id="cf"
                        placeholder="Enter ...">
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Keyword(s)</label>
                <input type="text" name="keywords[]" class="form-control" data-role="tagsinput"
                    placeholder="Keyword(s)">
            </div>
        </div>
    </div>

    {{-- <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" /> --}}
    {{-- <button onclick="history.go(-1);" class="btn btn-default">Back </button> --}}

    <a href="{{ url('rdmc-programs') }}" class="btn btn-default">Back</a>
    <input type="button" name="next" class="next btn btn-info" value="Next" />
    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
    <!-- /.card-body -->
    {{-- Page2 --}}
</fieldset>

<fieldset>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Start Date</label>
                <input type="month" class="form-control" name="start_date" autocomplete="false">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>End Date</label>
                <input type="month" class="form-control" name="end_date" autocomplete="false">
            </div>
        </div>
    </div>

    <div class="row">
        @if (auth()->user()->role == 'Admin')
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Extend Date</label>
                    <input type="month" class="form-control" name="extend_date" autocomplete="false">
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Program Leader</label>
                <input type="text" name="program_leader" class="form-control" placeholder="Program Leader"
                    list="leaderdtlist">
                <datalist id="leaderdtlist">
                    <option value="Leader 1"><span>Agency</span></option>
                    <option value="Leader 2"></option>
                    <option value="Leader 3"></option>
                </datalist>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Assistant Leader</label>
                <input type="text" name="assistant_leader" class="form-control" placeholder="Program Leader"
                    list="assisdtlist">
                <datalist id="assisdtlist">
                    <option value="Leader 1"><span>Agency</span></option>
                    <option value="Leader 2"></option>
                    <option value="Leader 3"></option>
                </datalist>
            </div>
        </div>
    </div>


    <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
    <input type="button" name="next" class="next btn btn-info" value="Next" />
</fieldset>

<fieldset>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Program Description</label>
                <textarea name="program_description" id="" cols="30" rows="5" style="resize: none;"
                    class="form-control"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Proposed Budget</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">PHP</span>
                    </div>
                    <input type="text" class="form-control" id="numin" name="approved_budget">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Amount of Released</label>
                <select name="budget_year" id="year" class="form-control">
                    <option value="Year 1">Year 1</option>
                    <option value="Year 2">Year 2</option>
                    <option value="Year 3">Year 3</option>
                    <option value="Year 4">Year 4</option>
                    <option value="Year 5">Year 5</option>
                    <option value="Year 6">Year 6</option>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label style="visibility: hidden">Amount of Released</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">PHP</span>
                    </div>
                    <input type="text" class="form-control" id="numin2" name="amount_released">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <label>Form of Development</label>
                <select name="form_of_development" id="" class="form-control custom-select">
                    <option value="" selected disabled>--Select Form of Development--
                    </option>
                    <option value="Local">Local</option>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </div>
        </div>
    </div>

    <input type="button" name="previous" class="previous btn btn-default" value="Previous" />

    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
</fieldset>
