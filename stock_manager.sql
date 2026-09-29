-- ============================================================
-- StockManager Pro - Base de données complète
-- Génère automatiquement à partir des migrations CodeIgniter 4
-- + données initiales (InitialDataSeeder)
-- Compatible MySQL 5.7+ / MariaDB 10.x
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `stock_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `stock_manager`;

-- ------------------------------------------------------------
-- Table : users
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','manager','employee') NOT NULL DEFAULT 'employee',
  `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Table : categories
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Table : products
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) UNSIGNED NOT NULL,
  `sku` VARCHAR(100) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `unit_price` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `unit` VARCHAR(50) NOT NULL DEFAULT 'pcs',
  `minimum_stock` INT(11) NOT NULL DEFAULT 0,
  `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Table : stock
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT(11) UNSIGNED NOT NULL,
  `warehouse_location` VARCHAR(255) NULL,
  `quantity` INT(11) NOT NULL DEFAULT 0,
  `reserved_quantity` INT(11) NOT NULL DEFAULT 0,
  `last_checked_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `stock_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Table : stock_movements
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `stock_movements`;
CREATE TABLE `stock_movements` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT(11) UNSIGNED NOT NULL,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `type` ENUM('in','out','adjustment','return') NOT NULL DEFAULT 'in',
  `quantity` INT(11) NOT NULL,
  `reference` VARCHAR(255) NULL,
  `notes` TEXT NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Table : alerts
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `alerts`;
CREATE TABLE `alerts` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT(11) UNSIGNED NOT NULL,
  `type` ENUM('low_stock','overstock','expired') NOT NULL DEFAULT 'low_stock',
  `message` TEXT NOT NULL,
  `status` ENUM('active','resolved') NOT NULL DEFAULT 'active',
  `created_at` DATETIME NULL,
  `resolved_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `alerts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table interne CodeIgniter pour le suivi des migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` VARCHAR(255) NOT NULL,
  `class` VARCHAR(255) NOT NULL,
  `group` VARCHAR(255) NOT NULL,
  `namespace` VARCHAR(255) NOT NULL,
  `time` INT(11) NOT NULL,
  `batch` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `migrations` (`version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
('2026-07-14-000001', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-07-14-000002', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-07-14-000003', 'App\\Database\\Migrations\\CreateProductsTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-07-14-000004', 'App\\Database\\Migrations\\CreateStockTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-07-14-000005', 'App\\Database\\Migrations\\CreateStockMovementsTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-07-14-000006', 'App\\Database\\Migrations\\CreateAlertsTable', 'default', 'App', UNIX_TIMESTAMP(), 1);

-- ============================================================
-- DONNÉES INITIALES (équivalent InitialDataSeeder.php)
-- ============================================================

-- Utilisateur administrateur
-- Identifiant : admin | Mot de passe : admin123
INSERT INTO `users` (`username`, `email`, `password`, `full_name`, `role`, `status`, `created_at`, `updated_at`) VALUES
('admin', 'admin@stockmanager.com', '$2b$10$jawl51vDxPWSxpEHn7V71.uSpSxZJtXnmvKJOm53d/FMleqQOvQLK', 'Administrateur', 'admin', 'active', NOW(), NOW());

-- Catégories
INSERT INTO `categories` (`name`, `description`, `status`, `created_at`, `updated_at`) VALUES
('Électronique', 'Articles électroniques et équipements', 'active', NOW(), NOW()),
('Informatique', 'Ordinateurs, accessoires IT', 'active', NOW(), NOW()),
('Fournitures de Bureau', 'Papier, stylos, etc.', 'active', NOW(), NOW()),
('Mobilier', 'Meubles de bureau et industriels', 'active', NOW(), NOW()),
('Matériaux Bruts', 'Matériaux et matières premières', 'active', NOW(), NOW());

-- Produits
INSERT INTO `products` (`category_id`, `sku`, `name`, `description`, `unit_price`, `unit`, `minimum_stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PROD-001', 'Moniteur LED 27"', 'Moniteur LED haute définition 27 pouces', 250.00, 'pcs', 5, 'active', NOW(), NOW()),
(1, 'PROD-002', 'Clavier Mécanique', 'Clavier gaming mécanique RGB', 120.00, 'pcs', 10, 'active', NOW(), NOW()),
(2, 'PROD-003', 'Souris Wireless', 'Souris sans fil ergonomique', 35.00, 'pcs', 15, 'active', NOW(), NOW()),
(3, 'PROD-004', 'Papier A4 500 feuilles', 'Ramette de papier 80g blanc', 5.50, 'ramette', 20, 'active', NOW(), NOW()),
(3, 'PROD-005', 'Stylos Bille Bleu (Boîte)', 'Boîte de 50 stylos bleus', 8.00, 'boîte', 10, 'active', NOW(), NOW()),
(4, 'PROD-006', 'Bureau Ergonomique', 'Bureau réglable en hauteur', 450.00, 'pcs', 2, 'active', NOW(), NOW());

-- Stock initial
INSERT INTO `stock` (`product_id`, `warehouse_location`, `quantity`, `reserved_quantity`, `created_at`, `updated_at`) VALUES
(1, 'A-1-1', 25, 0, NOW(), NOW()),
(2, 'A-1-2', 8, 0, NOW(), NOW()),
(3, 'A-2-1', 40, 0, NOW(), NOW()),
(4, 'B-1-1', 60, 0, NOW(), NOW()),
(5, 'B-1-2', 15, 0, NOW(), NOW()),
(6, 'C-1-1', 5, 0, NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- FIN DU SCRIPT
-- Pour importer : mysql -u root -p stock_manager < stock_manager.sql
-- Ou via phpMyAdmin : onglet "Importer" sur la base stock_manager
-- ============================================================
