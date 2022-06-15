<?php

namespace JulioMotol\AdminPanel;

use Closure;
use JulioMotol\AdminPanel\Navigation\NavigationManager;

class AdminPanelManager
{
    protected NavigationManager $sidebar;

    protected NavigationManager $account;

    protected Closure $account_avartar_resolver;

    public function __construct()
    {
        $this->sidebar = new NavigationManager();
        $this->account = new NavigationManager();
    }

    public function sidebar(): NavigationManager
    {
        return $this->sidebar;
    }

    public function account(): NavigationManager
    {
        return $this->account;
    }

    public function setAccountAvatarResolver(Closure $account_avartar_resolver): self
    {
        $this->account_avartar_resolver = $account_avartar_resolver;

        return $this;
    }

    public function resolveAccountAvatar(): ?string
    {
        return isset($this->account_avartar_resolver) ? ($this->account_avartar_resolver)() : null;
    }
}
