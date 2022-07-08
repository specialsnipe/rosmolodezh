<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class UsersFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const DATE_FROM = 'date_From';
    public const DATE_TO = 'date_To';
    public const PRICE_FROM = 'price_From';
    public const PRICE_TO = 'price_To';
    public const REGION = 'region';
    public const ORDER_BY_TITLE = 'order_By_Title';
    public const ORDER_BY_PRICE = 'order_By_Price';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::DATE_FROM => [$this, 'dateFrom'],
            self::DATE_TO => [$this, 'dateTo'],
            self::PRICE_FROM => [$this, 'priceFrom'],
            self::PRICE_TO => [$this, 'priceTo'],
            self::REGION => [$this, 'region'],
            self::ORDER_BY_TITLE => [$this, 'orderByTitle'],
            self::ORDER_BY_PRICE => [$this, 'orderByPrice'],

        ];

    }


    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function dateFrom(Builder $builder, $from)
    {
        $fromFormat = date("Y-m-d", strtotime($from));
        $builder->where('date', '>', $fromFormat);
    }

    public function dateTo(Builder $builder, $to)
    {
        $toFormat = date("Y-m-d", strtotime($to));
        $builder->where('date', '<', $toFormat);
    }

    public function priceFrom(Builder $builder, $from)
    {
        $builder->where('price', '>', $from);
    }

    public function priceTo(Builder $builder, $to)
    {
        $builder->where('price', '<', $to);
    }

    public function region(Builder $builder, $value)
    {
        $builder->whereIn('region', $value);
    }

    public function OrderByTitle(Builder $builder, $value)
    {
        $builder->orderBy('title', $value);
    }

    public function OrderByPrice(Builder $builder, $value)
    {
        $builder->orderBy('price', $value);
    }
}
