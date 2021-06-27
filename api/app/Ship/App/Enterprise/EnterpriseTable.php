<?php

namespace App\Ship\App\Enterprise;

class EnterpriseTable
{
    public const TABLE = 'enterprises';

    public const ID = 'objid'; // ID OE
    public const IDREF = 'objidref'; // ID parent
    public const SNAME = 'objsname'; // Код OE
    public const STATUS = 'objstatus'; // Статус ОЕ
    public const QUOTA = 'objquota'; // Квота по сотрудникам
    public const PARENTS = 'parents';
    public const IS_ROOT = 'is_root'; // Root элемент

    public static $tID = self::TABLE . '.' . self::ID;
    public static $tIDREF = self::TABLE . '.' . self::IDREF;
    public static $tSNAME = self::TABLE . '.' . self::SNAME;
    public static $tSTATUS = self::TABLE . '.' . self::STATUS;
    public static $tQUOTA = self::TABLE . '.' . self::QUOTA;
    public static $tPARENTS = self::TABLE . '.' . self::PARENTS;
    public static $tIS_ROOT = self::TABLE . '.' . self::IS_ROOT;

    public const FILLABLE = [
        self::ID,
        self::IDREF,
        self::SNAME,
        self::STATUS,
        self::QUOTA,
        self::PARENTS,
        self::IS_ROOT
    ];

    public const SORTABLE = [
        self::ID,
        self::SNAME,
    ];

}
