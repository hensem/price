/*
 Navicat Premium Data Transfer

 Source Server         : price.tekbesar.com
 Source Server Type    : MySQL
 Source Server Version : 50741
 Source Host           : price.tekbesar.com:3306
 Source Schema         : tekbesar_price

 Target Server Type    : MySQL
 Target Server Version : 50741
 File Encoding         : 65001

 Date: 28/02/2023 13:59:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `unit` bigint(20) UNSIGNED NOT NULL,
  `last_update` datetime(0) NOT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'hensem@gmail.com',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (1, 'Carrie Junior Hair & Body Wash', 1, '2021-11-15 03:39:34', 'hensem@gmail.com');
INSERT INTO `item` VALUES (2, 'Baby Formula', 1, '2021-11-15 03:40:05', 'hensem@gmail.com');
INSERT INTO `item` VALUES (3, 'Accu-Chek Guide Test Strip', 2, '2021-11-27 01:53:45', 'hensem@gmail.com');
INSERT INTO `item` VALUES (4, 'Aslene (Orlistat) 120mg', 2, '2021-11-27 01:56:52', 'hensem@gmail.com');
INSERT INTO `item` VALUES (5, 'Energizer Lithium AAA', 2, '2021-11-27 02:02:19', 'hensem@gmail.com');
INSERT INTO `item` VALUES (6, 'Equal Classic Tablets', 2, '2021-11-27 02:02:53', 'hensem@gmail.com');
INSERT INTO `item` VALUES (8, 'Heinz Squeeze Tomato Ketchup', 1, '2021-11-27 02:03:48', 'hensem@gmail.com');
INSERT INTO `item` VALUES (9, 'Hexidine', 3, '2021-11-27 02:11:52', 'hensem@gmail.com');
INSERT INTO `item` VALUES (10, 'Himalaya Karela', 2, '2021-11-27 02:12:39', 'hensem@gmail.com');
INSERT INTO `item` VALUES (11, 'Pampers', 2, '2021-11-27 13:21:45', 'hensem@gmail.com');
INSERT INTO `item` VALUES (12, 'Jardiance', 2, '2021-11-27 13:26:12', 'hensem@gmail.com');
INSERT INTO `item` VALUES (13, 'Beras Basmathi', 1, '2021-11-27 13:30:48', 'hensem@gmail.com');
INSERT INTO `item` VALUES (14, 'Kara Santan', 3, '2021-11-27 13:31:20', 'hensem@gmail.com');
INSERT INTO `item` VALUES (15, 'Matisse', 1, '2021-11-27 13:32:15', 'hensem@gmail.com');
INSERT INTO `item` VALUES (16, 'Milo Refill Pack', 1, '2021-11-27 13:33:44', 'hensem@gmail.com');
INSERT INTO `item` VALUES (17, 'Nestle Cerelac', 1, '2021-11-27 13:37:42', 'hensem@gmail.com');
INSERT INTO `item` VALUES (20, 'Nestle Omega Plus', 1, '2021-11-27 13:44:10', 'hensem@gmail.com');
INSERT INTO `item` VALUES (21, 'Panasonic Evolta AA', 2, '2021-11-27 13:45:06', 'hensem@gmail.com');
INSERT INTO `item` VALUES (22, 'Parodontax Herbal', 1, '2021-11-27 22:47:59', 'hensem@gmail.com');
INSERT INTO `item` VALUES (23, 'Pureen Liquid Cleanser No Flavour Refill Pack', 3, '2021-11-27 22:49:14', 'hensem@gmail.com');
INSERT INTO `item` VALUES (24, 'ProstaGard', 2, '2021-11-27 22:50:12', 'hensem@gmail.com');
INSERT INTO `item` VALUES (25, 'ReXTRA Heavy Duty PE Garbage Bag Large', 2, '2021-11-27 22:53:16', 'hensem@gmail.com');
INSERT INTO `item` VALUES (26, 'Sanmate Minerals Clumping Cat Litter', 1, '2021-11-27 22:53:55', 'hensem@gmail.com');
INSERT INTO `item` VALUES (27, 'Sunsweet Prune Juice with Pulp', 3, '2021-11-27 23:04:10', 'hensem@gmail.com');
INSERT INTO `item` VALUES (28, 'Wonda Coffee Mocha', 2, '2021-11-27 23:04:53', 'hensem@gmail.com');
INSERT INTO `item` VALUES (29, 'ZEISS AntiFOG Spray', 2, '2021-11-27 23:06:20', 'hensem@gmail.com');
INSERT INTO `item` VALUES (30, 'Nescafe Dark Roast Refill Pack', 4, '2021-11-28 13:26:57', 'hensem@gmail.com');
INSERT INTO `item` VALUES (31, 'Susu Full Cream 1L', 3, '2021-11-30 11:59:31', 'hensem@gmail.com');
INSERT INTO `item` VALUES (32, 'Susu coklat 200ml', 2, '2021-12-09 12:04:37', 'hensem@gmail.com');
INSERT INTO `item` VALUES (33, 'Cheese', 2, '2021-12-10 19:15:23', 'hensem@gmail.com');
INSERT INTO `item` VALUES (34, 'Dishwasher', 3, '2021-12-16 19:45:22', 'hensem@gmail.com');
INSERT INTO `item` VALUES (35, 'Top Detergent', 1, '2021-12-20 10:50:03', 'hensem@gmail.com');
INSERT INTO `item` VALUES (36, 'BD Ultra-Fine PRO 4mm 0.23mm (32G)', 2, '2021-12-29 18:22:19', 'hensem@gmail.com');
INSERT INTO `item` VALUES (38, 'Live-well Mecomin', 2, '2022-01-24 20:47:49', 'hensem@gmail.com');
INSERT INTO `item` VALUES (40, 'Sardines', 1, '2022-02-08 20:17:32', 'hensem@gmail.com');
INSERT INTO `item` VALUES (41, 'Tepung Gandum', 1, '2022-02-08 20:18:16', 'hensem@gmail.com');
INSERT INTO `item` VALUES (42, 'Black Pepper Coarse', 4, '2022-02-08 20:27:08', 'hensem@gmail.com');
INSERT INTO `item` VALUES (43, 'Lingham\'s Sos Cili', 3, '2022-02-12 14:56:16', 'hensem@gmail.com');
INSERT INTO `item` VALUES (44, 'DUOLEAF METHYLCOBALAMIN 500mcg', 2, '2022-02-12 16:15:07', 'hensem@gmail.com');
INSERT INTO `item` VALUES (45, 'Colgate Sensitive Pro-Relief', 2, '2022-02-12 16:19:25', 'hensem@gmail.com');
INSERT INTO `item` VALUES (46, 'Lee Kum Kee Sos Berperisa Tiram Sayuran', 4, '2022-02-12 16:25:15', 'hensem@gmail.com');
INSERT INTO `item` VALUES (47, 'Jam', 4, '2022-02-12 16:29:03', 'hensem@gmail.com');
INSERT INTO `item` VALUES (48, 'Baby Food', 4, '2022-02-12 16:31:10', 'hensem@gmail.com');
INSERT INTO `item` VALUES (49, 'Welch\'s Concord Grape Juice', 5, '2022-02-12 16:33:56', 'hensem@gmail.com');
INSERT INTO `item` VALUES (50, 'Brahim\'s Kuah Kurma', 2, '2022-02-12 16:40:07', 'hensem@gmail.com');
INSERT INTO `item` VALUES (52, 'Shoe Deodoriser', 4, '2022-02-18 21:11:43', 'hensem@gmail.com');
INSERT INTO `item` VALUES (53, 'Kiwi Wax Rich Shine & Protect', 2, '2022-02-23 20:56:12', 'hensem@gmail.com');
INSERT INTO `item` VALUES (54, 'Teh Boh Uncang', 2, '2022-03-08 23:21:38', 'hensem@gmail.com');
INSERT INTO `item` VALUES (55, 'Red Bull Plus Can 250ml', 2, '2022-03-11 00:29:14', 'hensem@gmail.com');
INSERT INTO `item` VALUES (56, 'Appeton MV Lysine', 5, '2022-03-16 21:10:42', 'hensem@gmail.com');
INSERT INTO `item` VALUES (57, 'Minyak Masak', 1, '2022-03-20 18:26:52', 'hensem@gmail.com');
INSERT INTO `item` VALUES (58, 'Lea & Perrins Worcestershire Sauce', 4, '2022-03-20 18:29:34', 'hensem@gmail.com');
INSERT INTO `item` VALUES (59, 'Meetball', 4, '2022-03-25 09:05:09', 'hensem@gmail.com');
INSERT INTO `item` VALUES (60, 'OneTouch Delica Lancets', 2, '2022-05-20 08:41:17', 'hensem@gmail.com');
INSERT INTO `item` VALUES (61, 'Sekoplas Heavy Duty L x10', 2, '2022-06-23 23:40:07', 'hensem@gmail.com');
INSERT INTO `item` VALUES (62, 'Kaya', 4, '2022-06-28 14:16:00', 'hensem@gmail.com');
INSERT INTO `item` VALUES (63, 'Jem', 4, '2022-06-28 14:17:18', 'hensem@gmail.com');
INSERT INTO `item` VALUES (64, 'Sosej Lembu', 1, '2022-06-28 14:19:48', 'hensem@gmail.com');
INSERT INTO `item` VALUES (65, 'Biskut Marie', 4, '2022-09-11 21:32:03', 'hensem@gmail.com');
INSERT INTO `item` VALUES (66, 'Maggi', 2, '2022-09-11 21:32:57', 'hensem@gmail.com');
INSERT INTO `item` VALUES (67, 'Kanji Ubi', 1, '2022-09-11 21:34:11', 'hensem@gmail.com');
INSERT INTO `item` VALUES (68, 'Tena Proskin Pants Plus', 6, '2022-10-05 10:45:35', 'hensem@gmail.com');
INSERT INTO `item` VALUES (69, 'Tiger Milk Mushroom', 7, '2022-11-29 13:05:12', 'hensem@gmail.com');
INSERT INTO `item` VALUES (70, 'Scott\'s Emulsion Orange', 5, '2022-12-12 21:43:04', 'hensem@gmail.com');
INSERT INTO `item` VALUES (71, 'Alcon Systane Ultra Eye Drop', 5, '2023-02-28 13:57:49', 'hensem@gmail.com');

-- ----------------------------
-- Table structure for item_shop
-- ----------------------------
DROP TABLE IF EXISTS `item_shop`;
CREATE TABLE `item_shop`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` bigint(20) UNSIGNED NOT NULL,
  `variant` bigint(20) UNSIGNED NOT NULL,
  `shop` bigint(20) UNSIGNED NOT NULL,
  `url` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `last_update` datetime(0) NOT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'hensem@gmail.com',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 182 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item_shop
-- ----------------------------
INSERT INTO `item_shop` VALUES (1, 1, 1, 3, '', 23.90, '2021-11-15 03:44:57', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (2, 1, 1, 4, 'https://www.lazada.com.my/products/carrie-junior-baby-hair-body-wash-1liter-i1767188399-s6911256777.html?', 23.70, '2021-11-15 03:45:32', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (3, 1, 1, 5, 'https://shopee.com.my/Carrie-Junior-Hair-Body-1000g-i.257853634.5651413364?ads_keyword=wkdaelpmissisiht&adsid=20130216&campaignid=11437762&position=26', 20.55, '2021-11-15 03:46:22', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (4, 2, 2, 1, '', 60.90, '2021-11-15 03:47:25', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (5, 2, 2, 2, '', 60.39, '2021-11-15 03:47:28', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (6, 3, 3, 6, '', 77.00, '2021-11-27 01:53:45', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (7, 4, 4, 6, '', 41.00, '2021-11-27 01:56:52', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (8, 4, 4, 7, '', 51.00, '2021-11-27 01:57:49', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (9, 4, 4, 4, 'https://www.lazada.com.my/products/kapsul-kurus-buang-lemak-30-capsules-1-box-exp-042023-one-month-supply-anti-obesity-fat-blockers-fat-burners-weight-losing-pecah-minyak-pecah-lemak-buang-minyak-aslenee-orlistats-i957892258-s2453250961.html?spm=a2o4k.searchlist.list.6.7bff674bO8ljDa&search=1', 51.50, '2021-11-27 02:01:28', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (10, 5, 5, 5, 'https://shopee.com.my/Energizer-Lithium-AAA-2pcs-i.52968176.5422721727?position=81', 17.10, '2021-11-27 02:02:19', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (11, 6, 6, 4, 'https://www.lazada.com.my/products/equal-classic-sweetener-tablets-500s-exp-012024-i2589228329-s11591292143.html', 30.29, '2021-11-27 02:02:54', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (13, 8, 8, 3, '', 10.28, '2021-11-27 02:03:49', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (14, 9, 9, 4, 'https://www.lazada.com.my/products/hexidine-chlorhexidine-gluconate-mouthwash-80ml500ml-i2386612098-s11677010644.html?spm=a2o4k.searchlist.list.3.6ee54cb15clYWV&search=1', 29.60, '2021-11-27 02:11:52', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (15, 10, 10, 6, '', 59.30, '2021-11-27 02:12:39', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (16, 10, 11, 5, 'https://shopee.com.my/Himalaya-Karela-Metabolic-wellness-60TAB-i.290136843.4047478644?sp_atk=0dacb62a-c871-4581-9eb2-579948f61219', 20.88, '2021-11-27 02:13:47', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (17, 10, 10, 5, 'https://shopee.com.my/Himalaya-Karela-2-X-60-Capsules-i.231410908.10303230451?sp_atk=cea09d3b-1ec1-47c7-96e4-e1083c45557b', 55.10, '2021-11-27 02:14:16', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (18, 11, 12, 1, '', 29.99, '2021-11-27 13:21:45', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (19, 11, 12, 8, '', 29.90, '2021-11-27 13:22:36', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (20, 11, 12, 9, '', 29.90, '2021-11-27 13:23:34', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (21, 11, 12, 3, '', 28.99, '2021-11-27 13:23:56', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (22, 12, 13, 10, '', 150.00, '2021-11-27 13:26:12', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (23, 12, 13, 6, '', 138.00, '2021-11-27 13:26:41', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (24, 12, 13, 7, 'https://www.doctoroncall.com.my/medicine/jardiance-25mg-r', 162.80, '2021-11-27 13:27:41', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (25, 13, 14, 4, 'https://www.lazada.com.my/products/jasmine-peacock-basmathi-super-long-5-rice-5kg-i1376474487-s4318274816.html?spm=a2o4k.searchlist.list.19.65ae7bdcJpnkF3&search=1', 37.50, '2021-11-27 13:30:49', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (26, 14, 15, 3, '', 3.15, '2021-11-27 13:31:20', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (27, 15, 16, 11, '', 179.00, '2021-11-27 13:32:15', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (28, 15, 16, 4, 'https://www.lazada.com.my/products/matisse-adult-dry-cat-food-salmon-tuna-10kg-i1056576845.html', 177.50, '2021-11-27 13:32:43', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (29, 15, 16, 5, 'https://shopee.com.my/Matisse-Salmon-Tuna-10Kg-i.2424239.1698296844', 171.75, '2021-11-27 13:33:00', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (30, 16, 17, 3, '', 21.50, '2021-11-27 13:33:44', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (31, 16, 17, 5, 'https://shopee.com.my/NESTLE-MILO-1KG-Active-Go-i.100659264.7293278171?position=39', 17.50, '2021-11-27 13:34:57', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (32, 17, 18, 12, '', 13.20, '2021-11-27 13:37:42', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (33, 17, 18, 13, '', 14.90, '2021-11-27 13:38:42', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (34, 17, 19, 13, '', 11.90, '2021-11-27 13:39:18', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (35, 2, 20, 14, '', 53.00, '2021-11-27 13:40:28', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (36, 2, 21, 4, 'https://www.lazada.com.my/products/nestle-nan-ha-stage-1-hypoallergenic-800g-i2386277019-s10265995407.html?search=store?search=store&spm=a2o4k.storeSpmB.promotionWhatYouSee_1210350934.0', 148.87, '2021-11-27 13:41:15', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (37, 2, 21, 5, 'https://shopee.com.my/NESTLE-NAN-HA-Step-1-2-(800g)-Exp-01-2022-i.145326807.2289727504?sp_atk=3baccc2a-c28a-4632-9594-27aea88d01f7', 101.50, '2021-11-27 13:41:39', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (38, 2, 21, 1, '', 109.40, '2021-11-27 13:42:22', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (39, 2, 21, 6, '', 114.50, '2021-11-27 13:42:36', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (40, 2, 22, 13, '', 103.30, '2021-11-27 13:43:11', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (41, 2, 22, 5, 'https://shopee.com.my/NESTLE-NAN-HA-Step-1-2-(800g)-Exp-01-2022-i.145326807.2289727504?sp_atk=3baccc2a-c28a-4632-9594-27aea88d01f7', 99.50, '2021-11-27 13:43:40', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (42, 20, 23, 3, '', 49.00, '2021-11-27 13:44:10', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (43, 20, 23, 4, 'https://www.lazada.com.my/products/1kg-nestle-omega-plus-milk-1kg-exp-042022-i2120213915-s8618882836.html?spm=a2o4k.searchlist.list.13.62806acaLqqWIf&search=1', 38.79, '2021-11-27 13:44:34', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (44, 21, 24, 3, '', 27.50, '2021-11-27 13:45:06', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (45, 21, 24, 4, 'https://www.lazada.com.my/products/panasonic-lr6eg8b-ec-evolta-battery-aa-size-8pcs-i2632620904-s11933031872.html?spm=a2o4k.searchlist.list.2.46e4104atceyaR&search=1&freeshipping=1', 19.50, '2021-11-27 13:46:35', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (46, 22, 25, 4, 'https://www.lazada.com.my/products/parodontax-herbal-gum-toothpaste-90g-i1453154074-s4720304190.html?spm=a2o4k.searchlist.list.59.6cce1a079LFQtj&search=1&freeshipping=1', 13.70, '2021-11-27 22:48:00', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (47, 22, 25, 6, '', 12.50, '2021-11-27 22:48:34', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (48, 23, 26, 3, '', 11.90, '2021-11-27 22:49:14', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (49, 23, 26, 1, '', 12.00, '2021-11-27 22:49:32', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (50, 24, 27, 5, 'https://shopee.com.my/Stay-Well-Live-Well-Prostagard-30-softgel-exp-07-2024-Anti-Aging-i.440963962.15843437951', 81.82, '2021-11-27 22:50:14', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (51, 24, 27, 6, '', 85.00, '2021-11-27 22:50:40', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (52, 23, 26, 4, 'https://www.lazada.com.my/products/pureen-liquid-cleanser-600ml-refill-pack-mint-no-flavor-orange-i1459440983-s4762648196.html?', 13.99, '2021-11-27 22:52:19', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (53, 25, 28, 3, '', 7.90, '2021-11-27 22:53:17', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (54, 26, 29, 11, '', 20.00, '2021-11-27 22:53:55', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (55, 26, 29, 4, 'https://www.lazada.com.my/products/sanmate-sanking-minerals-clumping-cat-litter-10l-7kg-cat-sand-pasir-kucing-premium-quality-imported-anti-bacterial-high-quality-long-lasting-odour-control-easy-cleaning-strong-clumping-low-dust-easy-cleaning-absorbent-pasir-hitam-i1940696847-s7808260603.html?spm=a2o4k.searchlist.list.5.30df72dfbvUDfu&search=1&freeshipping=1', 30.29, '2021-11-27 22:58:14', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (56, 26, 30, 4, 'https://www.lazada.com.my/products/sanmate-sanking-3-bags-x10liter-japanese-mineral-cat-litter-sand-pasir-kucing-murah-bekas-box-tandas-clumping-tak-berdebu-i970124619-s2509374592.html?spm=a2o4k.searchlist.list.15.30df72dfhbQPvh&search=1&freeshipping=1', 75.90, '2021-11-27 23:00:25', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (57, 27, 31, 3, '', 21.69, '2021-11-27 23:04:11', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (58, 28, 32, 3, '', 8.50, '2021-11-27 23:04:54', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (59, 29, 33, 5, 'https://shopee.com.my/ZEISS-Antifog-Spray-Kit-(15ml)-Anti-fog-i.92287500.3052458420?sp_atk=37b251d8-e763-4330-ab5f-e4bd9b5228db', 32.98, '2021-11-27 23:06:20', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (60, 30, 34, 5, 'https://shopee.com.my/Nescafe-Dark-Roast-RP-50g-i.52784309.2973365686?sp_atk=a94069cf-5ca6-4b67-b15e-f53f2ed568f0', 7.60, '2021-11-28 13:26:58', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (61, 30, 35, 4, 'https://www.lazada.com.my/products/nescafe-classic-dark-roast-200g-lebih-kaw-i2389351784-s10283207919.html?spm=a2o4k.searchlist.list.7.b9b95b7aqbdu87&search=1', 20.30, '2021-11-28 13:28:00', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (62, 13, 36, 3, '', 33.50, '2021-11-28 17:10:27', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (63, 13, 36, 4, 'https://www.lazada.com.my/products/beras-kashmir-faiza-basmathi-5kg-i1960434012-s7870336108.html?spm=a2o4k.searchlist.list.28.1b3a7ce32eXq4M&search=1', 36.98, '2021-11-28 17:28:37', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (64, 13, 36, 5, 'https://shopee.com.my/FAIZA-BERAS-KASHMIR-BASMATHI-RICE-5KG-i.124781304.5750978695?sp_atk=a8fd60be-c180-4b85-9052-e2ca58de808c', 35.50, '2021-11-28 17:29:28', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (65, 22, 25, 1, '', 10.99, '2021-11-29 18:39:47', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (66, 31, 37, 1, '', 6.69, '2021-11-30 11:59:32', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (67, 31, 38, 1, '', 6.20, '2021-12-03 19:00:40', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (68, 32, 39, 1, '', 6.40, '2021-12-09 12:04:37', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (69, 32, 40, 1, '', 4.69, '2021-12-09 12:06:29', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (70, 32, 41, 1, '', 4.00, '2021-12-09 12:07:00', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (71, 32, 42, 1, '', 8.85, '2021-12-09 12:07:52', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (72, 20, 23, 1, '', 29.20, '2021-12-10 18:54:41', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (73, 16, 17, 1, '', 17.95, '2021-12-10 18:57:15', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (74, 33, 43, 1, '', 18.99, '2021-12-10 19:15:27', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (75, 34, 44, 3, '', 18.89, '2021-12-16 19:45:29', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (76, 35, 45, 3, '', 23.40, '2021-12-20 10:50:04', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (77, 35, 45, 4, 'https://www.lazada.com.my/products/top-advance-micro-clean-tech-with-999-antivirus-super-whitepowder-detergent-38kg-i522186840-s1016852594.html?spm=a2o4k.searchlist.list.1.3c71427fw6wmPl&search=1', 23.30, '2021-12-20 11:00:22', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (78, 35, 45, 5, 'https://shopee.com.my/-5.5-TOP-Powder-Laundry-Detergent-Super-Colour-(3.8kg)-i.91852673.3458447337?sp_atk=7e4bad02-5745-4420-82cd-3d97892c3f0f', 26.10, '2021-12-20 11:01:01', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (79, 32, 46, 3, '', 8.50, '2021-12-20 11:09:35', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (80, 32, 39, 3, '', 6.90, '2021-12-20 11:12:43', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (81, 32, 47, 3, '', 10.75, '2021-12-20 11:15:10', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (82, 32, 48, 3, '', 13.20, '2021-12-20 11:16:14', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (83, 3, 3, 5, 'https://shopee.com.my/%F0%9F%92%AA-ACCU-CHEK-%F0%9F%92%AA-Accu-Chek-Test-Strips-50-Active-Instant-Performa-Guide-i.293208072.12918045458?sp_atk=5defbedc-5356-49b4-92c5-1bcf02a3a459', 74.90, '2021-12-28 15:21:50', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (84, 3, 3, 4, 'https://www.lazada.com.my/products/accu-check-guide-50-test-strips-accu-check-accu-chek-i861096999-s2095082642.html?spm=a2o4k.searchlist.list.9.25bc57350apump&search=1&freeshipping=1', 75.00, '2021-12-28 15:22:15', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (85, 36, 49, 4, 'https://www.lazada.com.my/products/bd-ultra-fine-pro-pen-needles-4mm-32g-100-pcs-i2513655673-s11175552582.html?spm=a2o4k.searchlist.list.2.68466497LUCGVg&search=1&freeshipping=1', 55.50, '2021-12-29 18:22:19', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (86, 36, 49, 5, 'https://shopee.com.my/-100-pcs-box-BD-Ultra-Fine-Pro-Pen-Needles-4mm-(32G)-100s-i.200113498.11840808124?sp_atk=286d087e-a4eb-4fd1-b4ee-a7606b28831d', 59.30, '2021-12-29 18:22:52', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (87, 31, 50, 1, '', 5.35, '2021-12-30 16:02:34', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (88, 6, 51, 6, '', 8.50, '2022-01-06 19:28:30', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (89, 6, 6, 6, '', 25.50, '2022-01-06 19:28:54', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (90, 36, 49, 6, '', 61.90, '2022-01-06 19:30:03', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (91, 24, 27, 4, 'https://www.lazada.com.my/products/stay-well-prostagard-2x30s-foc-15s-pill-box-exp-82023-i1800136466.html', 80.76, '2022-01-13 22:04:18', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (92, 2, 52, 1, '', 34.50, '2022-01-17 16:39:58', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (93, 38, 53, 4, 'https://www.lazada.com.my/products/live-well-mecomin-mecobalamin-500mcg-b12-90-90-60-i492376669-s879514712.html?spm=a2o4k.searchlist.list.74.52491e56qCosTI&search=1', 88.80, '2022-01-24 20:47:49', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (94, 38, 53, 5, 'https://shopee.com.my/LIVE-WELL-MECOMIN-500mcg-For-Nerve-Pain-Damage-(Exp-Aug-2025)-i.51638042.12758427167?sp_atk=873ed8a6-82d0-47ba-afe5-ff72e3876169', 88.40, '2022-01-24 20:48:30', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (95, 13, 36, 15, '', 35.00, '2022-01-27 21:04:41', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (96, 30, 35, 15, '', 14.88, '2022-01-27 21:11:10', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (97, 31, 38, 15, '', 6.00, '2022-01-27 21:12:04', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (98, 40, 54, 15, '', 7.20, '2022-02-01 20:29:51', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (99, 40, 55, 1, '', 8.95, '2022-02-08 20:17:32', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (100, 41, 56, 1, '', 3.20, '2022-02-08 20:18:16', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (101, 42, 57, 1, '', 12.30, '2022-02-08 20:27:08', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (102, 17, 58, 1, '', 12.50, '2022-02-08 20:29:19', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (103, 17, 18, 2, '', 11.90, '2022-02-08 20:30:53', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (104, 2, 59, 2, '', 63.50, '2022-02-08 22:13:22', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (105, 22, 25, 16, '', 12.50, '2022-02-12 11:46:58', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (106, 23, 26, 15, '', 12.75, '2022-02-12 14:37:35', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (107, 43, 60, 15, '', 6.10, '2022-02-12 14:56:16', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (108, 43, 61, 15, '', 5.50, '2022-02-12 14:57:19', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (109, 44, 62, 16, '', 34.00, '2022-02-12 16:15:09', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (110, 45, 63, 16, '', 18.80, '2022-02-12 16:19:27', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (111, 6, 6, 17, '', 31.00, '2022-02-12 16:21:13', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (112, 31, 37, 15, '', 6.50, '2022-02-12 16:22:14', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (113, 46, 64, 15, '', 6.20, '2022-02-12 16:25:16', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (114, 47, 65, 15, '', 11.50, '2022-02-12 16:29:04', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (115, 48, 66, 15, '', 5.85, '2022-02-12 16:31:10', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (116, 49, 67, 15, '', 5.85, '2022-02-12 16:33:57', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (117, 50, 68, 15, '', 6.70, '2022-02-12 16:40:07', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (118, 48, 69, 4, 'https://www.lazada.com.my/products/ready-stock-happybaby-superfood-puffs-organic-grain-snack-purple-carrot-blueberry-60g-i1370332630-s4292464296.html', 20.80, '2022-02-14 21:40:06', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (119, 48, 69, 5, 'https://shopee.com.my/(READY-STOCK)-Organic-HAPPY-BABY-Superfood-Puffs-Veggies-Fruit-Grain-(6-Flavours)-60g.-8-months-i.298475157.6047796139?sp_atk=96567c59-7c7a-4d35-94a4-011a41a71f52', 22.49, '2022-02-14 21:43:56', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (120, 52, 70, 1, '', 16.90, '2022-02-18 21:11:43', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (121, 21, 71, 1, '', 17.10, '2022-02-18 21:12:42', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (122, 53, 72, 1, '', 9.90, '2022-02-23 20:56:12', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (123, 43, 61, 1, '', 4.79, '2022-02-23 20:56:49', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (124, 17, 18, 18, '', 11.90, '2022-02-26 15:41:30', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (125, 4, 4, 19, '', 42.00, '2022-02-26 20:04:14', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (126, 2, 2, 20, '', 60.90, '2022-02-28 02:24:25', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (127, 44, 62, 4, 'https://www.lazada.com.my/products/duoleaf-methylcobalamin-500mcg-vitamin-b12-i2749848982-s13029357943.html', 41.80, '2022-03-05 00:52:06', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (128, 2, 73, 2, '', 72.50, '2022-03-06 11:56:18', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (129, 11, 74, 18, '', 68.50, '2022-03-06 12:01:46', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (130, 28, 32, 21, '', 8.25, '2022-03-08 23:20:28', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (131, 54, 75, 21, '', 14.05, '2022-03-08 23:21:38', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (132, 17, 18, 22, '', 14.90, '2022-03-11 00:27:41', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (133, 55, 76, 22, '', 15.90, '2022-03-11 00:29:15', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (134, 11, 74, 2, '', 29.95, '2022-03-11 21:20:22', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (135, 56, 77, 23, '', 47.60, '2022-03-16 21:10:42', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (136, 57, 78, 3, '', 29.70, '2022-03-20 18:26:54', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (137, 58, 79, 3, '', 9.90, '2022-03-20 18:29:34', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (138, 6, 6, 5, 'https://shopee.com.my/Equal-Classic-Tablets-(500\'s-300\'s-100\'s)-i.200167897.15750481776', 30.00, '2022-03-25 07:01:01', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (139, 16, 80, 3, '', 23.60, '2022-03-25 09:03:38', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (140, 59, 81, 3, '', 12.55, '2022-03-25 09:05:10', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (141, 17, 18, 1, '', 11.89, '2022-04-29 17:22:33', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (142, 60, 82, 24, '', 35.00, '2022-05-20 08:41:17', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (143, 60, 82, 6, '', 38.00, '2022-05-20 08:42:08', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (144, 6, 51, 24, '', 28.90, '2022-05-20 08:42:58', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (145, 4, 4, 24, '', 40.00, '2022-05-20 08:43:36', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (146, 60, 82, 5, 'https://shopee.com.my/Onetouch-Delica-Lancet-Easy-Pain-free-Blood-Glucose-Testing-(100\'s)-i.421835068.5686906104', 31.50, '2022-05-20 10:49:29', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (147, 60, 82, 4, 'https://www.lazada.com.my/products/onetouch-delica-lancet-100s-easy-pain-free-blood-glucose-testing-expiry-nov-2022-i2097956670.html', 31.30, '2022-05-20 10:50:38', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (148, 28, 83, 3, '', 2.60, '2022-05-24 19:17:29', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (149, 3, 3, 24, '', 78.00, '2022-06-17 11:46:32', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (150, 61, 84, 1, '', 6.90, '2022-06-23 23:40:07', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (151, 31, 85, 1, '', 5.29, '2022-06-23 23:41:39', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (152, 17, 18, 3, '', 11.99, '2022-06-28 14:14:40', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (153, 62, 86, 3, '', 6.20, '2022-06-28 14:16:00', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (154, 63, 87, 3, '', 11.70, '2022-06-28 14:17:19', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (155, 64, 88, 3, '', 8.60, '2022-06-28 14:19:49', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (156, 36, 49, 24, '', 69.00, '2022-08-04 19:49:26', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (157, 12, 13, 24, '', 137.00, '2022-08-04 19:50:11', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (158, 41, 56, 3, '', 7.80, '2022-09-11 21:30:50', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (159, 65, 89, 3, '', 6.00, '2022-09-11 21:32:03', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (160, 66, 90, 3, '', 4.65, '2022-09-11 21:32:57', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (161, 67, 91, 3, '', 2.40, '2022-09-11 21:34:11', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (162, 44, 62, 6, '', 45.00, '2022-09-11 21:36:11', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (163, 11, 92, 2, '', 27.95, '2022-09-12 20:14:35', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (164, 2, 73, 25, '', 71.90, '2022-09-17 12:07:50', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (165, 17, 18, 25, '', 11.90, '2022-09-17 12:09:20', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (166, 2, 93, 26, '', 61.50, '2022-09-26 09:44:37', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (167, 2, 73, 15, '', 86.90, '2022-09-28 21:58:12', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (168, 2, 52, 15, '', 39.90, '2022-09-28 21:59:24', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (169, 2, 93, 27, '', 61.50, '2022-09-30 03:02:50', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (170, 68, 94, 5, 'https://shopee.com.my/TENA-Pants-Plus-(ProSkin)-M-1-Carton-(6packs)-i.395165931.11105064704', 159.99, '2022-10-05 10:45:35', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (171, 31, 95, 15, '', 6.85, '2022-10-10 22:11:43', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (172, 31, 37, 3, '', 7.86, '2022-10-18 22:52:41', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (173, 13, 96, 3, '', 37.50, '2022-10-18 22:54:06', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (174, 11, 97, 1, '', 30.90, '2022-10-20 16:58:04', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (175, 9, 9, 5, 'https://shopee.com.my/Hexidine-Mouth-Wash-Solution-500ml-80ml-Chlorhexidine-for-mouth-ulcer-sore-throat-dental-i.196392478.13855141899', 29.90, '2022-11-21 00:00:58', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (176, 69, 98, 4, 'https://www.lazada.com.my/products/i1081006332-s2986266680.html', 139.00, '2022-11-29 13:05:12', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (177, 2, 93, 2, '', 59.90, '2022-12-12 21:35:31', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (178, 11, 97, 2, '', 31.65, '2022-12-12 21:37:22', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (179, 70, 99, 6, '', 12.50, '2022-12-12 21:43:04', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (180, 11, 100, 15, '', 56.88, '2023-01-29 18:36:12', 'hensem@gmail.com');
INSERT INTO `item_shop` VALUES (181, 71, 101, 24, '', 10.90, '2023-02-28 13:57:49', 'hensem@gmail.com');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `column` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rec_id` bigint(20) UNSIGNED NOT NULL,
  `old_value` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `new_value` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES (1, 'item_shop', 'price', 43, '37.80', '37.79', 'hensem@gmail.com', '2021-11-29 19:17:55');
INSERT INTO `log` VALUES (2, 'item_shop', 'price', 43, '37.79', '38.79', 'hensem@gmail.com', '2021-12-01 09:43:05');
INSERT INTO `log` VALUES (3, 'item_shop', 'price', 28, '168.00', '171', 'hensem@gmail.com', '2021-12-01 17:22:53');
INSERT INTO `log` VALUES (4, 'item_shop', 'url', 28, 'https://www.lazada.com.my/products/matisse-adult-dry-cat-food-salmon-tuna-10kg-i1056576845-s2877814092.html?spm=a2o4k.searchlist.list.4.5a031a70HuOCel&search=1', 'https://checkout.lazada.com.my/shipping?spm=a2o4k.pdp_revamp.main_page.bottom_bar_main_button', 'hensem@gmail.com', '2021-12-01 17:22:53');
INSERT INTO `log` VALUES (5, 'item_shop', 'url', 28, 'https://checkout.lazada.com.my/shipping?spm=a2o4k.pdp_revamp.main_page.bottom_bar_main_button', 'https://www.lazada.com.my/products/i1056576845-s2877814092.html?urlFlag=true&mp=1&spm=spm%3Da2o4k.order_details.item_title.1', 'hensem@gmail.com', '2021-12-01 17:30:55');
INSERT INTO `log` VALUES (6, 'item_shop', 'price', 62, '33.50', '33', 'hensem@gmail.com', '2021-12-03 20:11:54');
INSERT INTO `log` VALUES (7, 'item_shop', 'price', 62, '33.00', '33.5', 'hensem@gmail.com', '2021-12-03 20:12:17');
INSERT INTO `log` VALUES (8, 'item_shop', 'price', 50, '78.84', '80.31', 'hensem@gmail.com', '2021-12-06 09:02:39');
INSERT INTO `log` VALUES (9, 'item_shop', 'price', 66, '5.59', '6.5', 'hensem@gmail.com', '2021-12-28 14:16:16');
INSERT INTO `log` VALUES (10, 'item_shop', 'price', 50, '80.31', '81.81', 'hensem@gmail.com', '2022-01-13 21:24:19');
INSERT INTO `log` VALUES (11, 'item_shop', 'price', 52, '11.95', '13.99', 'hensem@gmail.com', '2022-02-09 22:52:29');
INSERT INTO `log` VALUES (12, 'item_shop', 'price', 91, '77.86', '82.9', 'hensem@gmail.com', '2022-02-14 00:37:20');
INSERT INTO `log` VALUES (13, 'item_shop', 'url', 91, 'https://www.lazada.com.my/products/stay-well-live-well-prostagard-30-softgel-x-2-bottle-foc-15-softgel-exp072024-i576838706-s1153440111.html', 'https://www.lazada.com.my/products/stay-well-twin-pack-prostagard-30sx2-15s-i2696857868-s12604688564.html', 'hensem@gmail.com', '2022-02-14 00:37:21');
INSERT INTO `log` VALUES (14, 'item_shop', 'price', 50, '81.81', '83.49', 'hensem@gmail.com', '2022-02-14 00:38:00');
INSERT INTO `log` VALUES (15, 'item_shop', 'url', 50, 'https://shopee.com.my/STAY-WELL-PROSTAGARD-CAPS-30S-PACK-OF-2-15S-GIFT-EXP07-2022-i.46101043.1472848742?sp_atk=ef647fb0-d1df-4a63-a02b-f4a95c087b6a', 'https://shopee.com.my/Stay-well-ProstaGARD-30s-x-2-FOC-15s-i.269538752.13728436505?sp_atk=a84a995e-389d-4146-8495-f00ed0652b0a', 'hensem@gmail.com', '2022-02-14 00:38:00');
INSERT INTO `log` VALUES (16, 'item_shop', 'price', 44, '25.90', '27.5', 'hensem@gmail.com', '2022-02-17 08:58:45');
INSERT INTO `log` VALUES (17, 'item_shop', 'price', 58, '5.49', '8.5', 'hensem@gmail.com', '2022-02-17 09:01:11');
INSERT INTO `log` VALUES (18, 'item_shop', 'price', 65, '10.99', '12.5', 'hensem@gmail.com', '2022-02-18 19:40:01');
INSERT INTO `log` VALUES (19, 'item_shop', 'price', 91, '82.90', '83.7', 'hensem@gmail.com', '2022-02-26 07:32:37');
INSERT INTO `log` VALUES (20, 'item_shop', 'price', 91, '83.70', '82.2', 'hensem@gmail.com', '2022-02-26 07:48:52');
INSERT INTO `log` VALUES (21, 'item_shop', 'url', 91, 'https://www.lazada.com.my/products/stay-well-twin-pack-prostagard-30sx2-15s-i2696857868-s12604688564.html', 'https://www.lazada.com.my/products/stay-well-prostagard-staywell-prosta-gard-prostaguard-saw-palmetto-303015-i957326667-s2451374672.html', 'hensem@gmail.com', '2022-02-26 07:48:57');
INSERT INTO `log` VALUES (22, 'item_shop', 'price', 129, '72.00', '68.5', 'hensem@gmail.com', '2022-03-06 12:02:19');
INSERT INTO `log` VALUES (23, 'item_shop', 'price', 67, '5.29', '4.99', 'hensem@gmail.com', '2022-03-08 23:18:26');
INSERT INTO `log` VALUES (24, 'item_shop', 'price', 29, '162.00', '166.6', 'hensem@gmail.com', '2022-03-09 22:29:11');
INSERT INTO `log` VALUES (25, 'item_shop', 'url', 29, 'https://shopee.com.my/FARMINA-MATISSE-Premium-CAT-DRY-FOOD-Makanan-Kucing-10kg-i.156876093.9015363184?position=43', 'https://shopee.com.my/Farmina-Matisse-Salmon-Tuna-Cat-Food-10kg-i.191344538.6453080141', 'hensem@gmail.com', '2022-03-09 22:29:11');
INSERT INTO `log` VALUES (26, 'item_shop', 'price', 11, '28.62', '30.29', 'hensem@gmail.com', '2022-03-25 07:01:58');
INSERT INTO `log` VALUES (27, 'item_shop', 'url', 11, 'https://www.lazada.com.my/products/cny-equal-classic-500s-tablet-exp12024-i942478030-s2384742420.html?spm=a2o4k.searchlist.list.42.141c526f33PSMo&search=1', 'https://www.lazada.com.my/products/equal-classic-sweetener-tablets-500s-exp-012024-i2589228329-s11591292143.html', 'hensem@gmail.com', '2022-03-25 07:01:58');
INSERT INTO `log` VALUES (28, 'item_shop', 'price', 48, '12.00', '11.89', 'hensem@gmail.com', '2022-03-30 15:42:06');
INSERT INTO `log` VALUES (29, 'item_shop', 'price', 14, '27.80', '29.6', 'hensem@gmail.com', '2022-05-14 16:40:21');
INSERT INTO `log` VALUES (30, 'item_shop', 'price', 128, '68.50', '74.9', 'hensem@gmail.com', '2022-05-20 09:42:33');
INSERT INTO `log` VALUES (31, 'item_shop', 'price', 91, '82.20', '80.76', 'hensem@gmail.com', '2022-05-22 13:15:12');
INSERT INTO `log` VALUES (32, 'item_shop', 'url', 91, 'https://www.lazada.com.my/products/stay-well-prostagard-staywell-prosta-gard-prostaguard-saw-palmetto-303015-i957326667-s2451374672.html', 'https://www.lazada.com.my/products/stay-well-prostagard-2x30s-foc-15s-pill-box-exp-82023-i1800136466.html', 'hensem@gmail.com', '2022-05-22 13:15:13');
INSERT INTO `log` VALUES (33, 'item_shop', 'price', 50, '83.49', '81.82', 'hensem@gmail.com', '2022-05-22 13:15:54');
INSERT INTO `log` VALUES (34, 'item_shop', 'url', 50, 'https://shopee.com.my/Stay-well-ProstaGARD-30s-x-2-FOC-15s-i.269538752.13728436505?sp_atk=a84a995e-389d-4146-8495-f00ed0652b0a', 'https://shopee.com.my/Stay-Well-Live-Well-Prostagard-30-softgel-exp-07-2024-Anti-Aging-i.440963962.15843437951', 'hensem@gmail.com', '2022-05-22 13:15:54');
INSERT INTO `log` VALUES (35, 'item_shop', 'price', 100, '2.40', '3.2', 'hensem@gmail.com', '2022-06-08 13:13:53');
INSERT INTO `log` VALUES (36, 'item_shop', 'price', 18, '28.59', '30.89', 'hensem@gmail.com', '2022-06-08 13:14:28');
INSERT INTO `log` VALUES (37, 'item_shop', 'price', 141, '14.90', '14.5', 'hensem@gmail.com', '2022-06-14 21:03:26');
INSERT INTO `log` VALUES (38, 'item_shop', 'price', 123, '5.35', '4.79', 'hensem@gmail.com', '2022-06-17 11:43:50');
INSERT INTO `log` VALUES (39, 'item_shop', 'price', 65, '12.50', '10.99', 'hensem@gmail.com', '2022-06-20 16:07:46');
INSERT INTO `log` VALUES (40, 'item_shop', 'price', 30, '18.99', '21.5', 'hensem@gmail.com', '2022-06-28 14:17:59');
INSERT INTO `log` VALUES (41, 'item_shop', 'price', 28, '171.00', '169.99', 'hensem@gmail.com', '2022-07-06 22:56:00');
INSERT INTO `log` VALUES (42, 'item_shop', 'price', 139, '22.45', '23.6', 'hensem@gmail.com', '2022-09-11 21:29:26');
INSERT INTO `log` VALUES (43, 'item_shop', 'price', 48, '11.89', '11.9', 'hensem@gmail.com', '2022-09-11 21:35:04');
INSERT INTO `log` VALUES (44, 'item_shop', 'price', 29, '166.60', '171.75', 'hensem@gmail.com', '2022-10-05 10:23:12');
INSERT INTO `log` VALUES (45, 'item_shop', 'url', 29, 'https://shopee.com.my/Farmina-Matisse-Salmon-Tuna-Cat-Food-10kg-i.191344538.6453080141', 'https://shopee.com.my/Matisse-Salmon-Tuna-10Kg-i.2424239.1698296844', 'hensem@gmail.com', '2022-10-05 10:23:12');
INSERT INTO `log` VALUES (46, 'item_shop', 'price', 28, '169.99', '182', 'hensem@gmail.com', '2022-10-05 10:24:11');
INSERT INTO `log` VALUES (47, 'item_shop', 'url', 28, 'https://www.lazada.com.my/products/i1056576845-s2877814092.html?urlFlag=true&mp=1&spm=spm%3Da2o4k.order_details.item_title.1', 'https://www.lazada.com.my/products/matisse-cat-dry-formula-10kg-salmontunachickenturkey-i2033179944-s8073289048.html', 'hensem@gmail.com', '2022-10-05 10:24:11');
INSERT INTO `log` VALUES (48, 'item_shop', 'price', 128, '74.90', '71.9', 'hensem@gmail.com', '2022-10-10 22:08:22');
INSERT INTO `log` VALUES (49, 'item_shop', 'price', 97, '6.50', '6', 'hensem@gmail.com', '2022-10-10 22:12:06');
INSERT INTO `log` VALUES (50, 'item_shop', 'price', 141, '14.50', '11.89', 'hensem@gmail.com', '2022-10-18 22:55:46');
INSERT INTO `log` VALUES (51, 'item_shop', 'price', 18, '30.89', '29.99', 'hensem@gmail.com', '2022-10-18 22:56:28');
INSERT INTO `log` VALUES (52, 'item_shop', 'price', 103, '13.20', '11.9', 'hensem@gmail.com', '2022-11-21 21:34:39');
INSERT INTO `log` VALUES (53, 'item_shop', 'price', 174, '29.99', '31.99', 'hensem@gmail.com', '2022-11-21 21:35:42');
INSERT INTO `log` VALUES (54, 'item_shop', 'price', 128, '71.90', '74.9', 'hensem@gmail.com', '2022-11-24 06:58:00');
INSERT INTO `log` VALUES (55, 'item_shop', 'price', 66, '6.50', '6.69', 'hensem@gmail.com', '2022-12-01 13:00:06');
INSERT INTO `log` VALUES (56, 'item_shop', 'price', 67, '4.99', '6.2', 'hensem@gmail.com', '2022-12-01 13:01:06');
INSERT INTO `log` VALUES (57, 'item_shop', 'price', 174, '31.99', '30.9', 'hensem@gmail.com', '2022-12-06 09:04:04');
INSERT INTO `log` VALUES (58, 'item_shop', 'price', 164, '73.50', '71.9', 'hensem@gmail.com', '2022-12-12 21:26:24');
INSERT INTO `log` VALUES (59, 'item_shop', 'price', 165, '13.20', '11.9', 'hensem@gmail.com', '2022-12-12 21:29:00');
INSERT INTO `log` VALUES (60, 'item_shop', 'price', 28, '182.00', '177.5', 'hensem@gmail.com', '2022-12-13 22:46:12');
INSERT INTO `log` VALUES (61, 'item_shop', 'url', 28, 'https://www.lazada.com.my/products/matisse-cat-dry-formula-10kg-salmontunachickenturkey-i2033179944-s8073289048.html', 'https://www.lazada.com.my/products/matisse-adult-dry-cat-food-salmon-tuna-10kg-i1056576845.html', 'hensem@gmail.com', '2022-12-13 22:46:12');
INSERT INTO `log` VALUES (62, 'item_shop', 'price', 23, '148.00', '138', 'hensem@gmail.com', '2022-12-26 22:57:18');
INSERT INTO `log` VALUES (63, 'item_shop', 'price', 177, '64.80', '59.9', 'hensem@gmail.com', '2023-01-02 19:23:01');
INSERT INTO `log` VALUES (64, 'item_shop', 'price', 128, '74.90', '73.9', 'hensem@gmail.com', '2023-01-11 21:33:11');
INSERT INTO `log` VALUES (65, 'item_shop', 'price', 128, '73.90', '74.9', 'hensem@gmail.com', '2023-01-20 01:39:39');
INSERT INTO `log` VALUES (66, 'item_shop', 'price', 128, '74.90', '72.5', 'hensem@gmail.com', '2023-02-03 07:57:47');
INSERT INTO `log` VALUES (67, 'item_shop', 'price', 6, '73.90', '77', 'hensem@gmail.com', '2023-02-28 13:54:26');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` tinyint(4) NOT NULL,
  `last_update` datetime(0) NOT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'hensem@gmail.com',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES (1, 'Mydin Sek 18 SA', 0, '2021-09-28 03:32:41', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (2, '99 Speedmart 1491 Shah Alam Sek 18', 0, '2021-09-28 03:32:43', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (3, 'AEON Big Sek 23 SA', 0, '2021-09-28 03:32:46', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (4, 'Lazada', 1, '2021-09-28 03:32:49', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (5, 'Shopee', 1, '2021-11-15 03:45:59', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (6, 'AA Pharmacy Kota Kemuning', 0, '2021-11-27 01:53:11', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (7, 'DoctorOnCall', 1, '2021-11-27 01:57:31', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (8, '99 Speedmart 1663 Kuala Kubu Bharu', 0, '2021-11-27 13:22:10', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (9, '99 Speedmart 1290 Alam Avenue', 0, '2021-11-27 13:23:06', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (10, 'Klinik Dunia Medic Sek 23 SA', 0, '2021-11-27 13:25:40', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (11, 'Jingles', 0, '2021-11-27 13:31:46', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (12, '99 Speedmart 1797 Linggi', 0, '2021-11-27 13:37:11', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (13, 'Mydin Gong Badak', 0, '2021-11-27 13:38:10', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (14, 'Klinik Pediatrik Adek', 0, '2021-11-27 13:39:49', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (15, 'Giant Hypermarket Kemuning Utama', 0, '2022-01-27 21:03:57', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (16, 'AA Pharmacy PJ Old Town', 0, '2022-02-12 11:46:11', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (17, 'Caring Pharmacy PJ Old Town', 0, '2022-02-12 16:20:30', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (18, '99 Speedmart 2813 Shah Alam Sek 11', 0, '2022-02-26 15:38:12', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (19, 'Big Pharmacy Shah Alam Seksyen 19', 0, '2022-02-26 20:03:37', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (20, '99 Speedmart 1454 Taman Damai Morib', 0, '2022-02-28 02:23:38', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (21, 'Giant Hypermarket Shah Alam Stadium', 0, '2022-03-08 23:20:01', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (22, 'HeroMarket Bandar Puteri Puchong', 0, '2022-03-11 00:27:17', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (23, 'Multicare Pharmacy Seksyen 18, Shah Alam', 0, '2022-03-16 21:10:17', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (24, 'Wellfast Pharmacy Kota Kemuning', 0, '2022-05-18 20:28:49', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (25, '99 Speedmart 1718 - (ME) Lubok China', 0, '2022-09-17 12:07:08', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (26, '99 Speedmart 1022 - Sri Muda 1', 0, '2022-09-26 09:43:52', 'hensem@gmail.com');
INSERT INTO `shop` VALUES (27, '99 Speedmart 1527 Shah Alam Sek19', 0, '2022-09-30 02:58:51', 'hensem@gmail.com');

-- ----------------------------
-- Table structure for t
-- ----------------------------
DROP TABLE IF EXISTS `t`;
CREATE TABLE `t`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cal` decimal(6, 1) NOT NULL,
  `stage` tinyint(3) UNSIGNED NOT NULL,
  `recovery` decimal(4, 1) NOT NULL,
  `pushup` tinyint(255) UNSIGNED NOT NULL,
  `situp` tinyint(255) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 160 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t
-- ----------------------------
INSERT INTO `t` VALUES (1, '2018-07-26', 100.0, 5, 0.0, 0, 0);
INSERT INTO `t` VALUES (2, '2018-07-27', 110.0, 6, 0.0, 0, 0);
INSERT INTO `t` VALUES (3, '2018-07-30', 100.0, 7, 1.9, 0, 0);
INSERT INTO `t` VALUES (4, '2018-07-31', 110.0, 8, 3.1, 0, 0);
INSERT INTO `t` VALUES (5, '2018-08-01', 121.0, 9, 3.9, 0, 0);
INSERT INTO `t` VALUES (6, '2018-08-02', 133.1, 10, 5.0, 0, 0);
INSERT INTO `t` VALUES (7, '2018-08-13', 129.1, 11, 5.1, 0, 0);
INSERT INTO `t` VALUES (8, '2018-08-14', 133.0, 12, 3.6, 0, 0);
INSERT INTO `t` VALUES (9, '2018-08-21', 129.0, 13, 4.8, 0, 0);
INSERT INTO `t` VALUES (10, '2018-08-27', 107.5, 14, 4.8, 0, 0);
INSERT INTO `t` VALUES (11, '2018-08-29', 101.1, 1, 5.4, 0, 0);
INSERT INTO `t` VALUES (12, '2018-09-03', 100.0, 2, 4.3, 0, 0);
INSERT INTO `t` VALUES (13, '2018-09-04', 103.0, 3, 4.8, 0, 0);
INSERT INTO `t` VALUES (14, '2018-09-24', 100.0, 4, 4.5, 0, 0);
INSERT INTO `t` VALUES (15, '2018-09-25', 103.0, 5, 4.6, 0, 0);
INSERT INTO `t` VALUES (16, '2018-09-26', 106.1, 6, 3.2, 0, 0);
INSERT INTO `t` VALUES (17, '2018-09-27', 109.3, 7, 4.5, 0, 0);
INSERT INTO `t` VALUES (18, '2018-10-03', 100.0, 8, 5.3, 0, 0);
INSERT INTO `t` VALUES (19, '2018-10-05', 100.0, 9, 3.6, 0, 0);
INSERT INTO `t` VALUES (20, '2018-10-30', 100.0, 10, 4.9, 0, 0);
INSERT INTO `t` VALUES (21, '2018-10-31', 103.0, 11, 3.4, 0, 0);
INSERT INTO `t` VALUES (22, '2018-11-07', 100.0, 12, 5.1, 0, 0);
INSERT INTO `t` VALUES (23, '2018-11-09', 100.0, 13, 2.5, 0, 0);
INSERT INTO `t` VALUES (24, '2018-11-13', 100.0, 14, 3.9, 0, 0);
INSERT INTO `t` VALUES (25, '2018-11-14', 103.0, 1, 3.1, 0, 0);
INSERT INTO `t` VALUES (26, '2018-11-16', 100.0, 2, 4.9, 0, 0);
INSERT INTO `t` VALUES (27, '2018-11-19', 100.0, 3, 6.0, 0, 0);
INSERT INTO `t` VALUES (28, '2018-11-21', 100.0, 4, 1.0, 0, 0);
INSERT INTO `t` VALUES (29, '2018-11-28', 100.0, 5, 2.7, 0, 0);
INSERT INTO `t` VALUES (30, '2019-02-11', 100.0, 6, 4.3, 0, 0);
INSERT INTO `t` VALUES (31, '2019-02-12', 103.0, 7, 5.4, 0, 0);
INSERT INTO `t` VALUES (32, '2019-02-13', 106.1, 8, 5.4, 0, 0);
INSERT INTO `t` VALUES (33, '2019-02-14', 109.3, 9, 1.1, 0, 0);
INSERT INTO `t` VALUES (34, '2019-02-20', 100.0, 10, 5.0, 0, 0);
INSERT INTO `t` VALUES (35, '2019-02-21', 103.0, 11, 4.7, 0, 0);
INSERT INTO `t` VALUES (36, '2019-02-22', 106.1, 12, 5.2, 0, 0);
INSERT INTO `t` VALUES (37, '2019-02-27', 100.0, 13, 5.4, 0, 0);
INSERT INTO `t` VALUES (38, '2019-08-20', 100.0, 14, 99.0, 0, 0);
INSERT INTO `t` VALUES (39, '2019-08-21', 103.0, 1, 2.1, 0, 0);
INSERT INTO `t` VALUES (40, '2019-08-22', 106.1, 2, 1.8, 0, 0);
INSERT INTO `t` VALUES (41, '2019-09-03', 100.0, 3, 3.8, 0, 0);
INSERT INTO `t` VALUES (42, '2019-09-04', 103.0, 4, 3.6, 0, 0);
INSERT INTO `t` VALUES (43, '2019-09-05', 106.1, 5, 2.6, 0, 0);
INSERT INTO `t` VALUES (44, '2019-09-06', 109.3, 6, 3.3, 0, 0);
INSERT INTO `t` VALUES (45, '2019-10-07', 100.0, 7, 4.3, 0, 0);
INSERT INTO `t` VALUES (46, '2019-10-14', 100.0, 8, 4.7, 0, 0);
INSERT INTO `t` VALUES (47, '2019-10-16', 100.0, 9, 2.7, 0, 0);
INSERT INTO `t` VALUES (48, '2019-10-19', 100.0, 10, 2.7, 0, 0);
INSERT INTO `t` VALUES (49, '2019-10-20', 101.0, 11, 3.4, 0, 0);
INSERT INTO `t` VALUES (50, '2019-10-21', 102.0, 12, 4.0, 0, 0);
INSERT INTO `t` VALUES (51, '2019-10-22', 103.0, 13, 5.4, 0, 0);
INSERT INTO `t` VALUES (52, '2019-10-25', 100.0, 14, 4.7, 0, 0);
INSERT INTO `t` VALUES (53, '2019-10-28', 100.0, 1, 4.3, 0, 0);
INSERT INTO `t` VALUES (54, '2019-10-29', 101.0, 2, 4.0, 0, 0);
INSERT INTO `t` VALUES (55, '2019-11-14', 100.0, 3, 3.3, 0, 0);
INSERT INTO `t` VALUES (56, '2019-11-15', 101.0, 4, 4.9, 0, 0);
INSERT INTO `t` VALUES (57, '2019-11-16', 102.0, 5, 1.0, 0, 0);
INSERT INTO `t` VALUES (58, '2019-11-17', 103.0, 6, 2.2, 0, 0);
INSERT INTO `t` VALUES (59, '2019-11-18', 104.0, 7, 3.5, 0, 0);
INSERT INTO `t` VALUES (60, '2019-11-19', 105.0, 8, 5.5, 0, 0);
INSERT INTO `t` VALUES (61, '2019-11-20', 106.1, 9, 2.3, 0, 0);
INSERT INTO `t` VALUES (62, '2019-11-21', 107.2, 10, 1.0, 0, 0);
INSERT INTO `t` VALUES (63, '2019-11-22', 108.3, 11, 4.2, 0, 0);
INSERT INTO `t` VALUES (64, '2019-11-23', 109.4, 12, 3.4, 0, 0);
INSERT INTO `t` VALUES (65, '2019-11-24', 110.5, 13, 2.2, 11, 10);
INSERT INTO `t` VALUES (66, '2019-11-25', 111.6, 14, 4.7, 20, 20);
INSERT INTO `t` VALUES (67, '2019-11-26', 112.7, 1, 2.4, 5, 5);
INSERT INTO `t` VALUES (68, '2019-11-29', 109.4, 2, 0.0, 0, 0);
INSERT INTO `t` VALUES (69, '2019-11-30', 110.5, 3, 3.4, 0, 20);
INSERT INTO `t` VALUES (70, '2019-12-01', 111.6, 4, 2.2, 0, 0);
INSERT INTO `t` VALUES (71, '2019-12-02', 112.7, 5, 5.0, 0, 20);
INSERT INTO `t` VALUES (72, '2019-12-03', 113.8, 6, 3.8, 0, 21);
INSERT INTO `t` VALUES (73, '2019-12-04', 114.9, 7, 3.3, 0, 22);
INSERT INTO `t` VALUES (74, '2019-12-05', 116.0, 8, 0.0, 0, 0);
INSERT INTO `t` VALUES (75, '2019-12-06', 117.2, 9, 0.0, 0, 30);
INSERT INTO `t` VALUES (76, '2019-12-07', 118.4, 10, 4.5, 0, 0);
INSERT INTO `t` VALUES (77, '2019-12-08', 119.6, 11, 0.0, 0, 30);
INSERT INTO `t` VALUES (78, '2019-12-09', 120.8, 12, 3.4, 0, 30);
INSERT INTO `t` VALUES (79, '2019-12-10', 122.0, 13, 0.0, 0, 30);
INSERT INTO `t` VALUES (80, '2019-12-12', 119.6, 14, 0.0, 0, 0);
INSERT INTO `t` VALUES (81, '2019-12-13', 120.8, 1, 0.0, 0, 0);
INSERT INTO `t` VALUES (82, '2019-12-18', 114.9, 2, 3.2, 0, 5);
INSERT INTO `t` VALUES (83, '2019-12-19', 116.0, 3, 1.4, 0, 10);
INSERT INTO `t` VALUES (84, '2019-12-21', 113.7, 4, 2.6, 0, 0);
INSERT INTO `t` VALUES (85, '2019-12-22', 114.8, 5, 1.5, 0, 0);
INSERT INTO `t` VALUES (86, '2019-12-23', 115.9, 6, 0.0, 0, 0);
INSERT INTO `t` VALUES (87, '2019-12-24', 117.1, 7, 0.0, 0, 0);
INSERT INTO `t` VALUES (88, '2019-12-25', 118.3, 8, 0.0, 0, 0);
INSERT INTO `t` VALUES (89, '2019-12-26', 119.5, 9, 3.0, 0, 0);
INSERT INTO `t` VALUES (90, '2019-12-30', 114.8, 10, 0.0, 0, 0);
INSERT INTO `t` VALUES (91, '2020-01-01', 112.5, 11, 2.6, 0, 0);
INSERT INTO `t` VALUES (92, '2020-01-02', 113.6, 12, 2.0, 0, 0);
INSERT INTO `t` VALUES (93, '2020-01-06', 109.1, 13, 1.0, 0, 0);
INSERT INTO `t` VALUES (94, '2020-01-07', 110.2, 14, 3.4, 0, 0);
INSERT INTO `t` VALUES (95, '2020-01-09', 108.0, 1, 1.0, 0, 0);
INSERT INTO `t` VALUES (96, '2020-01-13', 103.7, 2, 2.2, 0, 0);
INSERT INTO `t` VALUES (97, '2020-01-14', 104.7, 3, 2.2, 0, 20);
INSERT INTO `t` VALUES (98, '2020-01-20', 100.0, 4, 5.0, 0, 20);
INSERT INTO `t` VALUES (99, '2020-01-24', 100.0, 5, 5.6, 0, 21);
INSERT INTO `t` VALUES (100, '2020-01-28', 100.0, 6, 4.3, 0, 20);
INSERT INTO `t` VALUES (101, '2020-02-02', 100.0, 7, 4.2, 0, 0);
INSERT INTO `t` VALUES (102, '2020-02-03', 101.0, 8, 5.0, 0, 0);
INSERT INTO `t` VALUES (103, '2020-02-06', 100.0, 9, 4.1, 0, 0);
INSERT INTO `t` VALUES (104, '2020-02-07', 101.0, 10, 2.2, 0, 20);
INSERT INTO `t` VALUES (105, '2020-02-10', 100.0, 11, 1.0, 0, 20);
INSERT INTO `t` VALUES (106, '2020-02-11', 101.0, 12, 3.3, 0, 20);
INSERT INTO `t` VALUES (107, '2020-02-12', 102.0, 13, 1.7, 0, 20);
INSERT INTO `t` VALUES (108, '2020-02-13', 103.0, 14, 2.5, 0, 20);
INSERT INTO `t` VALUES (109, '2020-02-16', 100.0, 1, 3.0, 0, 20);
INSERT INTO `t` VALUES (110, '2020-02-19', 100.0, 2, 3.2, 0, 20);
INSERT INTO `t` VALUES (111, '2020-02-20', 101.0, 3, 1.0, 0, 20);
INSERT INTO `t` VALUES (112, '2020-02-21', 102.0, 4, 1.0, 0, 20);
INSERT INTO `t` VALUES (113, '2020-02-24', 100.0, 5, 3.8, 0, 20);
INSERT INTO `t` VALUES (114, '2020-02-25', 101.0, 6, 1.0, 0, 20);
INSERT INTO `t` VALUES (115, '2020-02-26', 102.0, 7, 3.5, 0, 20);
INSERT INTO `t` VALUES (116, '2021-12-22', 100.0, 8, 0.0, 0, 0);
INSERT INTO `t` VALUES (117, '2021-12-27', 100.0, 9, 0.0, 0, 0);
INSERT INTO `t` VALUES (118, '2021-12-28', 101.0, 10, 5.8, 0, 0);
INSERT INTO `t` VALUES (119, '2021-12-29', 102.0, 11, 4.2, 0, 0);
INSERT INTO `t` VALUES (120, '2021-12-30', 103.0, 12, 3.4, 0, 0);
INSERT INTO `t` VALUES (121, '2021-12-31', 104.0, 13, 3.9, 0, 0);
INSERT INTO `t` VALUES (122, '2022-01-02', 101.9, 14, 3.2, 0, 0);
INSERT INTO `t` VALUES (123, '2022-01-04', 100.0, 1, 1.0, 0, 0);
INSERT INTO `t` VALUES (124, '2022-01-05', 101.0, 2, 2.7, 0, 0);
INSERT INTO `t` VALUES (125, '2022-01-06', 102.0, 3, 3.2, 0, 0);
INSERT INTO `t` VALUES (126, '2022-01-11', 100.0, 4, 5.6, 0, 0);
INSERT INTO `t` VALUES (127, '2022-01-12', 101.0, 5, 4.9, 0, 0);
INSERT INTO `t` VALUES (128, '2022-01-14', 100.0, 6, 5.1, 0, 0);
INSERT INTO `t` VALUES (129, '2022-01-16', 100.0, 7, 3.5, 0, 0);
INSERT INTO `t` VALUES (130, '2022-01-17', 101.0, 8, 1.0, 0, 0);
INSERT INTO `t` VALUES (131, '2022-01-19', 100.0, 9, 3.4, 0, 0);
INSERT INTO `t` VALUES (132, '2022-01-21', 100.0, 10, 3.8, 0, 0);
INSERT INTO `t` VALUES (133, '2022-01-24', 100.0, 11, 6.0, 0, 0);
INSERT INTO `t` VALUES (134, '2022-02-09', 100.0, 12, 2.3, 0, 0);
INSERT INTO `t` VALUES (135, '2022-03-24', 100.0, 13, 0.0, 0, 0);
INSERT INTO `t` VALUES (136, '2022-05-30', 100.0, 14, 5.2, 0, 0);
INSERT INTO `t` VALUES (137, '2022-06-08', 100.0, 1, 3.6, 0, 0);
INSERT INTO `t` VALUES (138, '2022-06-09', 101.0, 2, 0.0, 3, 0);
INSERT INTO `t` VALUES (139, '2022-06-10', 102.0, 3, 4.4, 0, 0);
INSERT INTO `t` VALUES (140, '2022-06-13', 100.0, 4, 1.0, 0, 0);
INSERT INTO `t` VALUES (141, '2022-06-15', 100.0, 5, 4.0, 0, 0);
INSERT INTO `t` VALUES (142, '2022-06-20', 100.0, 6, 4.4, 0, 0);
INSERT INTO `t` VALUES (143, '2022-06-24', 100.0, 7, 4.2, 0, 0);
INSERT INTO `t` VALUES (144, '2022-06-27', 100.0, 8, 4.1, 0, 0);
INSERT INTO `t` VALUES (145, '2022-06-29', 100.0, 9, 5.0, 0, 0);
INSERT INTO `t` VALUES (146, '2022-07-06', 100.0, 10, 4.4, 0, 0);
INSERT INTO `t` VALUES (147, '2022-07-12', 100.0, 11, 3.9, 0, 0);
INSERT INTO `t` VALUES (148, '2022-07-13', 101.0, 12, 5.5, 0, 0);
INSERT INTO `t` VALUES (149, '2022-09-26', 100.0, 13, 3.8, 0, 0);
INSERT INTO `t` VALUES (150, '2022-09-28', 100.0, 14, 5.1, 0, 0);
INSERT INTO `t` VALUES (151, '2022-09-29', 101.0, 1, 5.8, 0, 0);
INSERT INTO `t` VALUES (152, '2022-09-30', 102.0, 2, 4.9, 0, 0);
INSERT INTO `t` VALUES (153, '2022-10-04', 100.0, 3, 4.1, 0, 0);
INSERT INTO `t` VALUES (154, '2022-10-05', 101.0, 4, 3.4, 0, 0);
INSERT INTO `t` VALUES (155, '2022-10-06', 102.0, 5, 4.5, 0, 0);
INSERT INTO `t` VALUES (156, '2022-10-07', 103.0, 6, 2.3, 0, 0);
INSERT INTO `t` VALUES (157, '2022-11-29', 100.0, 7, 0.0, 4, 0);
INSERT INTO `t` VALUES (158, '2022-12-08', 100.0, 8, 0.0, 1, 0);
INSERT INTO `t` VALUES (159, '2022-12-09', 101.0, 9, 5.0, 0, 0);

-- ----------------------------
-- Table structure for unit
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_update` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'hensem@gmail.com',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO `unit` VALUES (1, 'kg', NULL, NULL);
INSERT INTO `unit` VALUES (2, 'piece', NULL, NULL);
INSERT INTO `unit` VALUES (3, 'litre', '2021-11-27 02:11:16', 'hensem@gmail.com');
INSERT INTO `unit` VALUES (4, 'gram', '2021-11-28 13:26:22', 'hensem@gmail.com');
INSERT INTO `unit` VALUES (5, 'ml', '2022-02-12 14:55:31', 'hensem@gmail.com');
INSERT INTO `unit` VALUES (6, 'carton', '2022-10-05 10:44:45', 'hensem@gmail.com');
INSERT INTO `unit` VALUES (7, 'day', '2022-11-29 13:01:37', 'hensem@gmail.com');

-- ----------------------------
-- Table structure for variant
-- ----------------------------
DROP TABLE IF EXISTS `variant`;
CREATE TABLE `variant`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `item` bigint(20) UNSIGNED NOT NULL,
  `unit` float NOT NULL,
  `last_update` datetime(0) NOT NULL,
  `updated_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'hensem@gmail.com',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 102 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of variant
-- ----------------------------
INSERT INTO `variant` VALUES (1, '1kg', 1, 1, '2021-11-15 03:40:44', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (2, 'Anmumlac Infacare Step 2 650g', 2, 0.65, '2021-11-15 03:41:40', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (3, '50s', 3, 50, '2021-11-27 01:53:45', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (4, '30\'s', 4, 30, '2021-11-27 01:56:52', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (5, '2 pcs', 5, 2, '2021-11-27 02:02:19', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (6, '500\'s', 6, 500, '2021-11-27 02:02:54', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (8, '567g', 8, 0.567, '2021-11-27 02:03:48', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (9, '500ml', 9, 0.5, '2021-11-27 02:11:52', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (10, '60x2', 10, 120, '2021-11-27 02:12:39', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (11, '60', 10, 60, '2021-11-27 02:13:12', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (12, 'Huggies Dry Pants M 60+4', 11, 64, '2021-11-27 13:21:45', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (13, '25mg', 12, 30, '2021-11-27 13:26:12', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (14, 'Jasmine Peacock 5kg', 13, 5, '2021-11-27 13:30:49', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (15, '200ml', 14, 0.2, '2021-11-27 13:31:20', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (16, '10kg', 15, 10, '2021-11-27 13:32:15', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (17, '1kg', 16, 1, '2021-11-27 13:33:44', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (18, '500g', 17, 0.5, '2021-11-27 13:37:42', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (19, '250g', 17, 0.25, '2021-11-27 13:38:57', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (20, 'Nestle NAN HA Langkah 1 400g', 2, 0.4, '2021-11-27 13:40:28', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (21, 'Nestle NAN HA Langkah 1 800g', 2, 0.8, '2021-11-27 13:40:54', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (22, 'Nestle NAN HA Langkah 2 800g', 2, 0.8, '2021-11-27 13:43:11', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (23, '1kg', 20, 1, '2021-11-27 13:44:10', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (24, '8pcs', 21, 8, '2021-11-27 13:45:06', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (25, '90g', 22, 0.09, '2021-11-27 22:48:00', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (26, '600ml', 23, 0.6, '2021-11-27 22:49:14', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (27, '30+30+15', 24, 75, '2021-11-27 22:50:14', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (28, '10 bags', 25, 10, '2021-11-27 22:53:16', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (29, '10L 7kg', 26, 7, '2021-11-27 22:53:55', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (30, '3 Bags x 10 litre', 26, 21, '2021-11-27 22:59:03', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (31, '946ml', 27, 0.946, '2021-11-27 23:04:11', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (32, '4 x 240ml', 28, 4, '2021-11-27 23:04:54', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (33, '15ml', 29, 1, '2021-11-27 23:06:20', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (34, '50g', 30, 50, '2021-11-28 13:26:58', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (35, '200g', 30, 200, '2021-11-28 13:27:24', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (36, 'Faiza Kashmir Basmathi 5KG', 13, 5, '2021-11-28 17:10:01', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (37, 'Anlene', 31, 1, '2021-11-30 11:59:32', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (38, 'Nestle Just Milk', 31, 1, '2021-12-03 19:00:06', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (39, 'Anlene x4', 32, 4, '2021-12-09 12:04:37', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (40, 'Fernleaf x4', 32, 4, '2021-12-09 12:05:30', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (41, 'Marigold x3', 32, 3, '2021-12-09 12:06:06', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (42, 'Vico x6', 32, 6, '2021-12-09 12:07:27', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (43, 'Chesdale 24s', 33, 24, '2021-12-10 19:15:26', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (44, 'Sunlight 3.5l', 34, 3.5, '2021-12-16 19:45:26', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (45, '3.8kg', 35, 3.8, '2021-12-20 10:50:04', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (46, 'Milo x6', 32, 6, '2021-12-20 11:08:49', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (47, 'Goodday x6', 32, 6, '2021-12-20 11:14:36', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (48, 'Omega Plus x6', 32, 6, '2021-12-20 11:15:50', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (49, '100', 36, 100, '2021-12-29 18:22:19', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (50, 'Marigold UHT', 31, 1, '2021-12-30 16:01:52', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (51, '100\'s', 6, 100, '2022-01-06 19:27:47', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (52, 'Anmumlac Infacare Step 3 550 gram', 2, 0.55, '2022-01-17 16:39:58', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (53, '90+90+60', 38, 240, '2022-01-24 20:47:49', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (54, 'Marina 425 gram', 40, 0.425, '2022-02-01 20:29:51', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (55, 'Ayam Brand 425g', 40, 0.425, '2022-02-08 20:17:32', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (56, 'Cap Sauh 1kg', 41, 1, '2022-02-08 20:18:16', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (57, 'McCormick 35g', 42, 35, '2022-02-08 20:27:08', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (58, '350g', 17, 0.35, '2022-02-08 20:28:49', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (59, 'Nestle NAN Pro Langkah 2 600g', 2, 0.6, '2022-02-08 22:12:47', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (60, 'Squeeze 266ml', 43, 0.266, '2022-02-12 14:56:16', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (61, '250ml', 43, 0.25, '2022-02-12 14:56:50', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (62, '250mg 100\'S', 44, 100, '2022-02-12 16:15:08', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (63, 'Twin pack', 45, 2, '2022-02-12 16:19:26', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (64, '510g', 46, 510, '2022-02-12 16:25:15', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (65, 'Smucker\'s Sugar Free Strawberry Preserves  361g', 47, 361, '2022-02-12 16:29:03', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (66, 'Heinz Jars 110g', 48, 110, '2022-02-12 16:31:10', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (67, '295ml', 49, 295, '2022-02-12 16:33:57', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (68, '180g', 50, 1, '2022-02-12 16:40:07', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (69, 'Happy Baby Organic Superfood Puffs 60g', 48, 60, '2022-02-14 21:40:05', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (70, 'Kiwi 64g', 52, 64, '2022-02-18 21:11:43', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (71, '4pcs', 21, 4, '2022-02-18 21:12:15', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (72, '75ml', 53, 1, '2022-02-23 20:56:12', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (73, 'Anmum Essential Gold Langkah 3 1.1kg', 2, 1.1, '2022-03-05 22:00:15', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (74, 'Huggies Dry Diapers M 72 Tape', 11, 72, '2022-03-06 12:01:13', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (75, '100', 54, 100, '2022-03-08 23:21:38', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (76, '6\'s', 55, 6, '2022-03-11 00:29:15', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (77, '120ml', 56, 120, '2022-03-16 21:10:42', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (78, 'Vesawit 5kg', 57, 5, '2022-03-20 18:26:53', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (79, '290g', 58, 290, '2022-03-20 18:29:34', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (80, 'High Fibre 900g', 16, 0.9, '2022-03-25 09:02:58', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (81, 'Marina 370g', 59, 370, '2022-03-25 09:05:09', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (82, '100\'s', 60, 100, '2022-05-20 08:41:17', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (83, '240ml', 28, 1, '2022-05-24 19:16:54', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (84, '1', 61, 1, '2022-06-23 23:40:07', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (85, 'Goodday', 31, 1, '2022-06-23 23:41:14', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (86, 'Cap Kipas Udang 420g', 62, 420, '2022-06-28 14:16:00', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (87, 'Mackays Blueberry Preserve 340g', 63, 340, '2022-06-28 14:17:19', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (88, 'Ramly 340g', 64, 0.34, '2022-06-28 14:19:48', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (89, 'Roma Gold 2401g', 65, 240, '2022-09-11 21:32:03', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (90, 'Sajimee Mi Goren', 66, 5, '2022-09-11 21:32:57', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (91, 'Jati 500g', 67, 0.5, '2022-09-11 21:34:11', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (92, 'Huggies Dry Diapers L 60+4', 11, 64, '2022-09-12 20:13:52', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (93, 'Anmum Essential Langkah 3 1.1kg', 2, 1.1, '2022-09-26 09:29:30', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (94, 'M', 68, 1, '2022-10-05 10:45:35', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (95, 'Meadow Fresh Full Cream', 31, 1, '2022-10-10 22:11:11', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (96, 'Ketupat 5kg', 13, 5, '2022-10-18 22:53:38', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (97, 'Huggies Dry Pants L 50', 11, 50, '2022-10-20 16:57:31', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (98, 'GKB 60', 69, 60, '2022-11-29 13:05:12', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (99, '200ml', 70, 200, '2022-12-12 21:43:04', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (100, 'Huggies Dry Pants L 50 x2', 11, 100, '2023-01-29 18:35:40', 'hensem@gmail.com');
INSERT INTO `variant` VALUES (101, '5ml', 71, 1, '2023-02-28 13:57:49', 'hensem@gmail.com');

-- ----------------------------
-- View structure for v_item_shop
-- ----------------------------
DROP VIEW IF EXISTS `v_item_shop`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_item_shop` AS select `item_shop`.`id` AS `item_shop_id`,`item`.`id` AS `item_id`,`item`.`name` AS `item`,`variant`.`id` AS `variant_id`,`variant`.`name` AS `variant`,`unit`.`id` AS `unit_id`,`unit`.`name` AS `unit`,`variant`.`unit` AS `total_unit`,`shop`.`id` AS `shop_id`,`shop`.`name` AS `shop`,`item_shop`.`url` AS `url`,`item_shop`.`price` AS `price`,(`item_shop`.`price` / `variant`.`unit`) AS `price_per_unit`,`shop`.`url` AS `url_required` from ((((`item_shop` left join `item` on((`item_shop`.`item` = `item`.`id`))) left join `variant` on((`item_shop`.`variant` = `variant`.`id`))) left join `unit` on((`item`.`unit` = `unit`.`id`))) left join `shop` on((`item_shop`.`shop` = `shop`.`id`))) group by `item_shop`.`id`;

-- ----------------------------
-- View structure for v_item_variant
-- ----------------------------
DROP VIEW IF EXISTS `v_item_variant`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_item_variant` AS select `item`.`id` AS `id`,`item`.`name` AS `name`,`item`.`unit` AS `unit`,`item`.`last_update` AS `last_update`,`item`.`updated_by` AS `updated_by`,concat(`item`.`name`,concat(' ',`variant`.`name`)) AS `item_variant` from (`item` left join `variant` on((`variant`.`item` = `item`.`id`)));

SET FOREIGN_KEY_CHECKS = 1;
