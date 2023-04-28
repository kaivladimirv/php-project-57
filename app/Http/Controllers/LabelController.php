<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Label\StoreLabelRequest;
use App\Http\Requests\Label\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    public function index(): View
    {
        $labels = Label::all()->sortBy('id');

        return view('labels.index', compact('labels'));
    }

    public function create(): View
    {
        $label = new Label();

        return view('labels.create', compact('label', 'label'));
    }

    public function store(StoreLabelRequest $request): RedirectResponse
    {
        $label = new Label();
        $label->fill($request->validated());
        $label->save();

        flash(__('label.created-successfully'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label): RedirectResponse
    {
        $label->fill($request->validated());
        $label->save();

        flash(__('label.changed-successfully'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash(__('label.deleted-fail-is-used'))->error();

            return back();
        }

        $label->delete();

        flash(__('label.deleted-successfully'))->success();

        return redirect()->route('labels.index');
    }
}
