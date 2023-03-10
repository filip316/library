<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Details extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $values, $heading, $subheading, $rows, $placement, $link;
    public function __construct($type, $data, $placement)
    {
        $this->type = $type;
        $this->placement = $placement;
        $this->values = $data;

        if ($type == 'work') {
            $this->heading = $data->title;
            $this->subheading = $data->subtitle;
            $this->link = 'titul/' . $data->slug;
            $this->rows = collect([
                'Původní název' => [$data->original_title],
                'Autor' => [$data->author->name, $data->author->id == 1 ? null : ('/autor/' . $data->author->slug)],
                'Popis' => [$data->description],
                'Rok' => [$data->year],
                'Jazyk' => [ucfirst($data->language)],
                'Literární druh' => [ucfirst($data->class)],
                'Literární žánr' => [ucfirst($data->genre)],
                'Délka' => [is_null($data->number) ? null : ($data->number . ($data->class == 'lyrika' ? ' básní' : ($data->class == 'epika' ? ' kapitol' : ' dějství')))],
            ]);
        } elseif ($type == 'book') {
            $this->heading = $data->title;
            $this->subheading = $data->subtitle;
            $this->link = 'kniha/' . $data->work->slug . '/' . $data->id;
            $this->rows = collect([
                'Popis' => [ucfirst($data->description)],
                'Jazyk' => [ucfirst($data->language)],
                'Překladatel' => [$data->translator],
                'Ilustrátor' => [$data->illustrator],
                'Rozsah' => [is_null($data->length) ? null : ($data->length . ' stran')],
                'Nakladatelství' => [$data->house],
                'Rok vydání' => [$data->year],
                'Publikace' => [$data->publication],
                'Místo vydání' => [$data->place],
                'ISBN' => [$data->ISBN],
            ]);
        } elseif ($type == 'author') {
            $amount = count($data->works);

            $this->heading = $data->name;
            $this->subheading = null;
            $this->link = 'autor/' . $data->slug;
            $this->rows = collect([
                'Popis' => [$data->description],
                'Datum narození' => [is_null($data->birth_date) ? null : date('d. m. Y', strtotime($data->birth_date))],
                'Datum úmrtí' => [is_null($data->death_date) ? null : date('d. m. Y', strtotime($data->death_date))],
                'U nás v knihovně' => [$amount . ' titul' . ($amount == 1 ? '' : ($amount > 1 && $amount < 5 ? 'y' : 'ů'))],
            ]);
        } elseif ($type == 'user') {
            $this->heading = $data->name;
            $this->subheading = null;
            $this->link = 'ucet/' . $data->code;
            $this->rows = collect([
                'Kód čtenáře' => [$data->code],
                'Emailová adresa' => [$data->email],
                'Datum registrace' => [date('d. m. Y', strtotime($data->created_at))],
                'Otevřené rezervace' => [count($data->bookings)],
                'Knihovník' => auth()->user()->librarian == 1 ? [$data->librarian == 1 ? 'Ano' : 'Ne'] : [null],
                'Správce' => auth()->user()->librarian == 1 ? [$data->admin == 1 ? 'Ano' : 'Ne'] : [null],
            ]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.details');
    }
}
