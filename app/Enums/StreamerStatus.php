<?php 

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum  StreamerStatus: string implements HasColor, HasLabel

{
    case PendingApproval = 'pending_approval';
    case Rejected = 'rejected';
    case Approved = 'approved';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PendingApproval => 'Pending Approval',
            self::Rejected => 'Rejected',
            self::Approved => 'Approved',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PendingApproval => 'warning',
            self::Rejected => 'gray',
            self::Approved => 'success',           
        };
    }
}

?>