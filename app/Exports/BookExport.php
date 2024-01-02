<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BookExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::with('category')->get()->map(function ($book, $index) {
            return [
                'No' => $index + 1,
                'Title' => $book->title,
                'Category' => $book->category->name,
                'Description' => $book->description,
                'Amount' => $book->amount,
                'Cover' => $book->cover,
                'File PDF' => $book->pdf,
                'Created At' => $book->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Title',
            'Category',
            'Description',
            'Amount',
            'Cover',
            'File PDF',
            'Created At',
        ];
    }

    public function map($book): array
    {

        return [
            $book->no,
            $book->title,
            $book->category_name,
            $book->description,
            $book->amount,
            $book->cover,
            $book->pdf,
            $book->created_at,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FF008000']]],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Buku';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', $this->title());
                $event->sheet->mergeCells('A1:H1');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
