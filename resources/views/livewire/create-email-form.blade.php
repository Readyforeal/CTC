<div>
    <flux:modal.trigger name="create-email">
        <flux:button icon="envelope" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-email')">Compose email</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-email" :show="$errors->isNotEmpty()" focusable class="w-3xl" variant="flyout">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Compose email') }}</flux:heading>
            </div>

            <div>
                <flux:select wire:model.live="template" label="Template">
                    <flux:select.option value="">Select a template...</flux:select.option>
                    <flux:select.option value="initial_request">Initial bid request (All contacts)</flux:select.option>
                    <flux:select.option value="follow_up">Follow up on remaining bid requests (Remaining)</flux:select.option>
                    <flux:select.option value="update_all">Information update (All contacts)</flux:select.option>
                </flux:select>
            </div>
            
            <div>
                <flux:checkbox wire:model.live="hasAttachment" label="Has attachment"></flux:checkbox>
            </div>

            <div>
                <p class="mb-2">Recipients</p>
                @foreach ($bidTrackers as $bidTracker)
                    @if($bidTracker->account->contacts->count() == 0)
                        <flux:badge size="sm" color="red">{{ $bidTracker->account->name }}</flux:badge>
                    @else
                        <flux:badge size="sm" color="blue">{{ $bidTracker->account->name }}</flux:badge>
                    @endif
                @endforeach
                <flux:textarea class="mt-2" variant="subtle">
                    {{ $contacts }}
                </flux:textarea>
            </div>

            <div>
                <p class="mb-2">Content</p>

                <div class="border rounded-lg p-3">
                    @if($template == "initial_request")
                        <flux:text>Hello,</flux:text>
                        <flux:text class="mt-2">Craig Tuttle Construction is requesting an estimate for the {{ $project->name }} project located at {{ $project->address }}</flux:text>
                        @if ($hasAttachment)
                            <flux:text class="mt-2">See attached. Please review and let us know if you have any questions.</flux:text>
                        @endif
                        <flux:text class="mt-2">Due date</flux:text>
                        <flux:text>{{ $proposal->due_date }}</flux:text>
                    @elseif($template == "follow_up")
                        <flux:text>Hello,</flux:text>
                        <flux:text class="mt-2">This is a reminder that we're still waiting on an estimate we requested for the {{ $project->name }} project located at {{ $project->address }}.</flux:text>
                        @if ($hasAttachment)
                            <flux:text class="mt-2">See attached. Please review and let us know if you have any questions.</flux:text>
                        @endif
                        <flux:text class="mt-2">Due date</flux:text>
                        <flux:text>{{ $proposal->due_date }}</flux:text>
                    @else
                        <flux:text>No content</flux:text>
                    @endif
                </div>
            </div>


            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Done') }}</flux:button>
                </flux:modal.close>
            </div>
        </form>
    </flux:modal>
</div>