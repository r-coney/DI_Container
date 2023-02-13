<?php
declare(strict_types=1);

class Provider implements ProviderInterface
{
    /**
     * 依存関係
     *
     * @var array
     */
    private $dependencies = [];

    /**
     * 依存関係を登録
     */
    public function __construct()
    {
        $this->register();
    }

    /**
     * 依存関係を登録
     * このメソッド内でbind()を呼ぶ
     *
     * @return void
     */
    public function register(): void
    {
        // $this->bind()
    }

    /**
     * 抽象クラスと具象クラスの依存関係をバインド
     *
     * @param string $abstract
     * @param string $concrete
     * @return void
     */
    public function bind(string $abstract, string $concrete): void
    {
        if (isset($this->dependencies[$abstract])) {
            throw new InvalidArgumentException($abstract . ' has already bound');
        }

        $this->dependencies[$abstract] = $concrete;
    }

    /**
     * 登録された依存関係を取得
     *
     * @return array
     */
    public function dependencies(): array
    {
        return $this->dependencies;
    }
}
