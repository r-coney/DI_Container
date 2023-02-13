<?php
declare(strict_types=1);

interface ProviderInterface
{
    /**
     * 依存関係を登録
     *
     * @return void
     */
    public function register(): void;

    /**
     * 抽象クラスと具象クラスの依存関係をバインド
     *
     * @param string $abstract
     * @param string $concrete
     * @return void
     */
    public function bind(string $abstract, string $concrete): void;

    /**
     * 登録された依存関係を取得
     *
     * @return array
     */
    public function dependencies(): array;
}
