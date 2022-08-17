<?php
/**
 * Created by PhpStorm.
 * Filename: UrlStatus.php
 * User: Nguyễn Văn Ước
 * Date: 17/08/2022
 * Time: 16:37
 */

namespace App\Enums;

enum UrlStatus: string
{
    const NEW     = 'new';
    const PENDING = 'pending';
    const SUCCESS = 'success';
    const FAILED  = 'failed';
}
