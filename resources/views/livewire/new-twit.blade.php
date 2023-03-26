<div>
    <form wire:submit.prevent="createTwit" class="container px-5 py-4">
        <textarea name="newtwit" id="newtwit" rows="5" wire:model="newTwitBody" class="flex w-100 mt-2 mb-2 rounded" placeholder="What are you thinking?"></textarea>
        <button type="submit" class="btn btn-primary float-right mb-4" >Twit</button>
    </form>
    <hr class="my-4">
</div>
