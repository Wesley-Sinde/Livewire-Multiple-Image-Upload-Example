<div>
    <form>
        <div class=" add-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" class="form-control" wire:model="images" multiple>
                        @error('image.*') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button class="btn text-white btn-success" wire:click.prevent="store">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>