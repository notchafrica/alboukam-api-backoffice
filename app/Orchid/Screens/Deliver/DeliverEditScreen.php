<?php

namespace App\Orchid\Screens\Deliver;

use App\Models\Deliver;
use App\Orchid\Layouts\Deliver\DeliverEditLayout;
use App\Orchid\Layouts\Deliver\DeliverPasswordLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DeliverEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Deliver';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Details such as name, email and password';


    /**
     * @var Deliver
     */
    private $deliver;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Deliver $deliver): array
    {
        $this->deliver = $deliver;

        if (!$deliver->exists) {
            $this->name = 'Create Deliver';
        }

        return [
            'deliver' => $deliver
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->deliver->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::block(DeliverEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__('Update account\'s profile information and email address.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->deliver->exists)
                        ->method('save')
                ),
            Layout::block(DeliverPasswordLayout::class)
                ->title(__('Password'))
                ->description(__('Ensure your account is using a long, random password to stay secure.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->deliver->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * @param Deliver    $deliver
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Deliver $deliver, Request $request)
    {
        $request->validate([
            'deliver.email' => [
                'required',
                Rule::unique(Deliver::class, 'email')->ignore($deliver),
            ],
        ]);


        $deliverData = $request->get('deliver');
        if ($deliver->exists && isset($deliverDate['password']) && (string)$deliverData['password'] === '') {
            // When updating existing deliver null password means "do not change current password"
            unset($deliverData['password']);
        } else {
            $deliverData['password'] = Hash::make($deliverData['password']);
        }

        $deliver
            ->fill($deliverData)
            ->save();


        Toast::info(__('Deliver was saved.'));

        return redirect()->route('platform.systems.delivers');
    }

    /**
     * @param Deliver $deliver
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Deliver $deliver)
    {
        $deliver->delete();

        Toast::info(__('Deliver was removed'));

        return redirect()->route('platform.systems.delivers');
    }
}
