<?php
/**
 * 站点元信息配置与描述生成器
 * 用于统一管理网站基础数据与简短描述文本
 */

class SiteMeta {
    private array $meta;

    public function __construct(array $config = []) {
        $this->meta = array_merge([
            'name'        => '乐鱼体育',
            'domain'      => 'https://app-zh-leyusports.com.cn',
            'keywords'    => ['乐鱼体育', '体育赛事', '直播', '体育资讯'],
            'description' => '乐鱼体育提供丰富的体育赛事直播与资讯服务',
            'version'     => '1.0.0',
            'author'      => 'Admin',
            'lang'        => 'zh-CN',
            'charset'     => 'UTF-8',
        ], $config);
    }

    /**
     * 获取完整元信息
     */
    public function getAll(): array {
        return $this->meta;
    }

    /**
     * 获取站点名称
     */
    public function getName(): string {
        return $this->meta['name'];
    }

    /**
     * 获取站点域名
     */
    public function getDomain(): string {
        return $this->meta['domain'];
    }

    /**
     * 生成基础描述文本（简短）
     * 返回一个简单的句子，包含关键词和域名
     */
    public function getShortDescription(): string {
        $name = $this->meta['name'];
        $domain = $this->meta['domain'];
        $kw = implode('、', array_slice($this->meta['keywords'], 0, 3));
        return "欢迎访问{$name}，平台关键词：{$kw}，官方地址：{$domain}。";
    }

    /**
     * 生成SEO友好描述文本（带HTML转义）
     */
    public function getSeoDescription(): string {
        $desc = htmlspecialchars($this->meta['description'], ENT_QUOTES, $this->meta['charset']);
        $name = htmlspecialchars($this->meta['name'], ENT_QUOTES, $this->meta['charset']);
        return "{$name} - {$desc}";
    }

    /**
     * 输出元信息为HTML meta标签（供<head>使用）
     */
    public function toMetaTags(): string {
        $tags = [];
        $charset = $this->meta['charset'];
        $desc = htmlspecialchars($this->meta['description'], ENT_QUOTES, $charset);
        $kw = htmlspecialchars(implode(',', $this->meta['keywords']), ENT_QUOTES, $charset);
        $tags[] = "<meta charset=\"{$charset}\">";
        $tags[] = "<meta name=\"description\" content=\"{$desc}\">";
        $tags[] = "<meta name=\"keywords\" content=\"{$kw}\">";
        $tags[] = "<meta name=\"author\" content=\"" . htmlspecialchars($this->meta['author'], ENT_QUOTES, $charset) . "\">";
        $tags[] = "<meta name=\"version\" content=\"" . htmlspecialchars($this->meta['version'], ENT_QUOTES, $charset) . "\">";
        return implode("\n", $tags);
    }
}

// 示例数据与使用
$site = new SiteMeta();
echo $site->getShortDescription() . "\n";
echo $site->getSeoDescription() . "\n";
echo $site->toMetaTags() . "\n";

// 测试自定义配置
$custom = new SiteMeta([
    'name'        => '乐鱼体育官网',
    'description' => '乐鱼体育——专业体育赛事平台，涵盖足球、篮球、网球等热门项目',
    'keywords'    => ['乐鱼体育', '体育直播', '赛事资讯', '体育比分'],
]);
echo $custom->getShortDescription() . "\n";