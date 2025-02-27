<?php

namespace App\Libraries\EloquentFilter;

enum MatchMode: string
{
    case STARTS_WITH = 'startsWith';
    case CONTAINS = 'contains';
    case NOT_CONTAINS = 'notContains';
    case ENDS_WITH = 'endsWith';
    case EQUALS = 'equals';
    case NOT_EQUALS = 'notEquals';
    case IN = 'in';
    case NOT_IN = 'notIn';
    case LESS_THAN = 'lt';
    case LESS_THAN_OR_EQUAL_TO = 'lte';
    case GREATER_THAN = 'gt';
    case GREATER_THAN_OR_EQUAL_TO = 'gte';
    case BETWEEN = 'between';
    case DATE_IS = 'dateIs';
    case DATE_IS_NOT = 'dateIsNot';
    case DATE_BEFORE = 'dateBefore';
    case DATE_AFTER = 'dateAfter';
    case IS_NULL = 'isNull';
    case IS_NOT_NULL = 'isNotNull';
}
