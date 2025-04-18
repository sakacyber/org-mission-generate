<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Mission;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class MissionTable extends DataTableComponent
{
    protected $model = Mission::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setActionsInToolbarEnabled()
            ->setColumnSelectDisabled()
            ->setTableRowUrl(function ($row) {
                return route('missions.show', $row);
            })
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                if ($column->isField('start_date')) {
                    return [
                        'class' => 'text-center',
                    ];
                }

                return [];
            });
        ;
    }
    public function builder(): Builder
    {

        return Mission::query()
            ->with('people.department')
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Goal", "goal")
                ->sortable(),
            Column::make("Place", "place")
                ->sortable(),
            Column::make("Start date", "start_date")
                ->format(fn($value, $row): string => '<p>' . formatDate($value) . '</p>' . '<p>' . formatDate($row->end_date) . '</p>')
                ->html()
                ->sortable(),
            Column::make("People")
                ->label(fn($row): string => '<li>' . $row->people->take(2)->pluck('name')->implode('</li> <li>') . '</li>')
                ->html()
                ->sortable(),
            Column::make("Notes", "notes")
                ->label(fn($row, Column $column): string => $row->notes ?? '-') 
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'View ' . $row->name)
                        ->location(fn($row) => route('missions.show', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'p-2 bg-gray-200 rounded hover:bg-primary hover:text-white',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit ' . $row->name)
                        ->location(fn($row) => route('missions.edit', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'p-2 bg-blue-200 rounded hover:bg-primary hover:text-white',
                            ];
                        }),
                ]),
        ];
    }
}
