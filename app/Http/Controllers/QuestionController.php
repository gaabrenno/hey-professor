<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\SameQuestionRule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Response};

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions'         => user()->questions,
            'archivedQuestions' => user()->questions()->onlyTrashed()->get(),
        ]);
    }

    public function store(): RedirectResponse
    {

        $atributes = request()->validate([
            'title'    => ['required', 'string'],
            'question' => ['required', 'string', 'min:10', new SameQuestionRule(),
            ],
        ]);

        user()->questions()
            ->create([
                'title'    => $atributes['title'],
                'question' => $atributes['question'],
                'draft'    => true,
            ]);

        return back();
    }

    public function edit(Question $question): View
    {
        abort_unless(user()->can('update', $question), Response::HTTP_FORBIDDEN);

        return view('question.edit', compact('question'));
    }

    public function update(Question $question): RedirectResponse
    {
        abort_unless(user()->can('update', $question), Response::HTTP_FORBIDDEN);

        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $atribute, mixed $value, callable $fail) {
                    if ($value[strlen($value) - 1] !== '?') {
                        $fail('Are you sure it is a question? It should end with a question mark in the end.');
                    }
                },
            ],
        ]);
        $question->question = request()->question;
        $question->save();

        return to_route('question.index');
    }

    public function archive(Question $question): RedirectResponse
    {
        abort_unless(user()->can('archive', $question), Response::HTTP_FORBIDDEN);

        $question->delete();

        return back();
    }

    public function restore(int $id): RedirectResponse
    {
        // abort_unless(user()->can('restore', $question), Response::HTTP_FORBIDDEN);

        $question = Question::withTrashed()->find($id);

        $question->restore();

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        abort_unless(user()->can('destroy', $question), Response::HTTP_FORBIDDEN);

        $question->forceDelete();

        return back();
    }
}
