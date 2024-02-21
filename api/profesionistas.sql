# Host: 127.0.0.1  (Version 8.0.31)
# Date: 2024-02-08 08:59:09
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "categories"
#

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'placeholder.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "categories"
#

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Desarrollo web','Madiffy','logo.png','2024-01-15 21:57:45','2024-01-29 20:50:49'),(2,'Tecnología','Servicios tecnológicos','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(3,'Diseño','Servicios de diseño','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(4,'Educación','Servicios educativos','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(5,'Consultoría','Servicios de consultoría','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(6,'Gastronomía','Servicios gastronómicos','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(7,'Deporte','Servicios deportivos','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(8,'Arte','Servicios artísticos','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(9,'Finanzas','Servicios financieros','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(10,'Mantenimiento','Servicios de mantenimiento','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(11,'Entretenimiento','Servicios de entretenimiento','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(12,'Marketing','Servicios de marketing','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(13,'Moda','Servicios relacionados con la moda','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(14,'Viajes','Servicios de viaje','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(15,'Automotriz','Servicios automotrices','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(16,'Legal','Servicios legales','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(17,'Belleza','Servicios de belleza','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(18,'Inmobiliaria','Servicios inmobiliarios','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(19,'Medio Ambiente','Servicios ambientales','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(20,'Recursos Humanos','Servicios de recursos humanos','placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(21,'Mecanicos','Mecanico el romo','romo.jpg','2024-01-29 15:53:00','2024-01-29 15:53:00'),(22,'Holaaa','Madiffy.png','hola.png','2024-02-01 05:38:35','2024-02-01 05:38:35');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

#
# Structure for table "failed_jobs"
#

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "failed_jobs"
#


#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "migrations"
#

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2019_12_14_000001_create_personal_access_tokens_table',1),(10,'2024_01_10_175447_create_categories_table',1),(11,'2024_01_11_030852_create_specialities_table',1),(12,'2024_01_11_031701_create_specialist_table',1),(13,'2024_01_11_031951_create_recommendations_table',1),(14,'2024_01_11_032353_create_services_table',1),(15,'2024_01_11_170041_update_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

#
# Structure for table "oauth_access_tokens"
#

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "oauth_access_tokens"
#


#
# Structure for table "oauth_auth_codes"
#

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "oauth_auth_codes"
#


#
# Structure for table "oauth_clients"
#

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "oauth_clients"
#


#
# Structure for table "oauth_personal_access_clients"
#

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "oauth_personal_access_clients"
#


#
# Structure for table "oauth_refresh_tokens"
#

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "oauth_refresh_tokens"
#


#
# Structure for table "password_resets"
#

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "password_resets"
#


#
# Structure for table "personal_access_tokens"
#

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "personal_access_tokens"
#


#
# Structure for table "recommendations"
#

DROP TABLE IF EXISTS `recommendations`;
CREATE TABLE `recommendations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `specialist_id` int NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "recommendations"
#

/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
INSERT INTO `recommendations` VALUES (1,1,2,'Excelente servicio, muy recomendado',4.5,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(2,2,3,'Profesional altamente calificado',5.0,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(3,3,1,'Cumple con las expectativas',4.0,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(4,4,5,'Trabajo rápido y eficiente',4.8,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(5,5,4,'Atención al cliente excepcional',5.0,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(6,6,6,'Muy satisfecho con el servicio',4.7,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(7,7,8,'Explicaciones claras y detalladas',4.5,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(8,8,7,'Precios competitivos',4.2,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(9,9,10,'Superó mis expectativas',5.0,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(10,10,9,'Trato amable y profesional',4.6,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(11,11,12,'Servicio rápido y confiable',4.9,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(12,12,11,'Conocimientos amplios en el tema',4.8,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(13,13,14,'Recomendado para proyectos de diseño',4.7,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(14,14,13,'Atención personalizada',4.5,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(15,15,16,'Cumplió con los plazos establecidos',4.3,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(16,16,15,'Consejos útiles y prácticos',4.6,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(17,17,18,'Servicio legal de calidad',4.8,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(18,18,17,'Resolvió mis dudas de manera efectiva',4.5,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(19,19,20,'Experiencia gastronómica excepcional',5.0,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(20,20,19,'Servicio inmobiliario confiable',4.7,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(21,1,1,'Romito feo.',4.8,'2024-01-29 19:38:06','2024-01-29 19:38:06');
/*!40000 ALTER TABLE `recommendations` ENABLE KEYS */;

#
# Structure for table "services"
#

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'placeholder.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "services"
#

/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Consulta Médica Online','Consulta médica a través de videoconferencia',1,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(2,'Desarrollo de Aplicaciones Móviles','Creación de aplicaciones móviles personalizadas',2,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(3,'Diseño Gráfico','Servicios de diseño gráfico para marcas y empresas',3,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(4,'Clases de Idiomas','Enseñanza de idiomas a través de clases personalizadas',4,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(5,'Consultoría Empresarial','Asesoría para el crecimiento y desarrollo de empresas',5,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(6,'Catering para Eventos','Servicio de catering para eventos y celebraciones',6,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(7,'Entrenamiento Personalizado','Entrenamiento físico personalizado y asesoramiento nutricional',7,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(8,'Arte Digital','Creación de arte digital personalizado',8,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(9,'Asesoría Financiera','Asesoramiento financiero para individuos y empresas',9,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(10,'Servicio de Plomería','Reparación y mantenimiento de instalaciones de fontanería',10,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(11,'Animación de Fiestas','Animación y entretenimiento para fiestas y eventos',11,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(12,'Marketing Digital','Estrategias de marketing en línea para empresas',12,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(13,'Asesoría de Estilo','Asesoramiento en moda y estilo personal',13,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(14,'Agencia de Viajes','Planificación y organización de viajes personalizados',14,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(15,'Reparación de Automóviles','Servicios de reparación y mantenimiento de vehículos',15,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(16,'Asesoría Legal','Servicios legales para individuos y empresas',16,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(17,'Salón de Belleza','Servicios de belleza y cuidado personal',17,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(18,'Agencia Inmobiliaria','Compra, venta y alquiler de propiedades',18,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(19,'Consultoría Ambiental','Asesoría en temas relacionados con el medio ambiente',19,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(20,'Recursos Humanos','Servicios de reclutamiento y gestión de personal',20,'placeholder.png','2024-01-15 21:57:45','2024-01-15 21:57:45'),(21,'Desarrollo web','Madiffy',1,'logo.png','2024-01-29 19:49:31','2024-01-29 19:49:31');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

#
# Structure for table "specialists"
#

DROP TABLE IF EXISTS `specialists`;
CREATE TABLE `specialists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'placeholder.png',
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "specialists"
#

/*!40000 ALTER TABLE `specialists` DISABLE KEYS */;
INSERT INTO `specialists` VALUES (1,'Médico especializado en medicina general','placeholder.png',1,1,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(2,'Desarrollador de aplicaciones con experiencia en iOS y Android','placeholder.png',2,2,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(3,'Diseñador gráfico con enfoque en branding','placeholder.png',3,3,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(4,'Profesor de inglés con certificación TEFL','placeholder.png',4,4,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(5,'Consultor empresarial con más de 10 años de experiencia','placeholder.png',5,5,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(6,'Chef con experiencia en cocina internacional','placeholder.png',6,6,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(7,'Entrenador personal certificado en fitness y nutrición','placeholder.png',7,7,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(8,'Artista digital con especialización en ilustración','placeholder.png',8,8,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(9,'Asesor financiero con licencia y experiencia en inversiones','placeholder.png',9,9,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(10,'Fontanero con más de 15 años de experiencia','placeholder.png',10,10,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(11,'Animador de eventos con habilidades de malabarismo y magia','placeholder.png',11,11,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(12,'Especialista en marketing digital con certificación Google Ads','placeholder.png',12,12,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(13,'Asesor de moda con experiencia en asesoramiento de celebridades','placeholder.png',13,13,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(14,'Agente de viajes con conocimientos en destinos exóticos','placeholder.png',14,14,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(15,'Mecánico automotriz con certificación ASE','placeholder.png',15,15,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(16,'Abogado especializado en derecho comercial','placeholder.png',16,16,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(17,'Estilista de belleza con especialización en maquillaje','placeholder.png',17,17,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(18,'Agente inmobiliario con amplio conocimiento del mercado local','placeholder.png',18,18,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(19,'Consultor ambiental con experiencia en evaluación de impacto','placeholder.png',19,19,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(20,'Especialista en recursos humanos con experiencia en reclutamiento','placeholder.png',20,20,'2024-01-15 21:57:45','2024-01-15 21:57:45'),(21,'Desarrollo web','Madiffy.png',1,1,'2024-01-30 02:51:29','2024-01-30 02:51:29'),(22,'Desarrollo web','Madiffy.png',1,1,'2024-01-31 15:07:28','2024-01-31 15:07:28');
/*!40000 ALTER TABLE `specialists` ENABLE KEYS */;

#
# Structure for table "specialities"
#

DROP TABLE IF EXISTS `specialities`;
CREATE TABLE `specialities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "specialities"
#

/*!40000 ALTER TABLE `specialities` DISABLE KEYS */;
INSERT INTO `specialities` VALUES (1,'Medicina General','Diagnóstico y tratamiento de enfermedades comunes','2024-01-15 21:57:45','2024-01-15 21:57:45'),(2,'Desarrollo de Aplicaciones Móviles','Creación de aplicaciones para dispositivos móviles','2024-01-15 21:57:45','2024-01-15 21:57:45'),(3,'Diseño Gráfico','Creación de identidad visual y diseño de marca','2024-01-15 21:57:45','2024-01-15 21:57:45'),(4,'Idiomas','Enseñanza de diversos idiomas','2024-01-15 21:57:45','2024-01-15 21:57:45'),(5,'Consultoría Empresarial','Asesoramiento para el crecimiento empresarial','2024-01-15 21:57:45','2024-01-15 21:57:45'),(6,'Catering y Eventos','Servicios de catering para eventos especiales','2024-01-15 21:57:45','2024-01-15 21:57:45'),(7,'Entrenamiento Físico','Programas de entrenamiento personalizado','2024-01-15 21:57:45','2024-01-15 21:57:45'),(8,'Arte Digital','Creación de arte visual en formato digital','2024-01-15 21:57:45','2024-01-15 21:57:45'),(9,'Asesoría Financiera','Consejería en temas financieros y de inversión','2024-01-15 21:57:45','2024-01-15 21:57:45'),(10,'Plomería','Reparación y mantenimiento de instalaciones de fontanería','2024-01-15 21:57:45','2024-01-15 21:57:45'),(11,'Animación de Eventos','Entretenimiento y animación para fiestas','2024-01-15 21:57:45','2024-01-15 21:57:45'),(12,'Marketing Digital','Estrategias de marketing en plataformas digitales','2024-01-15 21:57:45','2024-01-15 21:57:45'),(13,'Asesoría de Estilo','Consejos y recomendaciones de moda y estilo','2024-01-15 21:57:45','2024-01-15 21:57:45'),(14,'Agencia de Viajes','Planificación y organización de viajes personalizados','2024-01-15 21:57:45','2024-01-15 21:57:45'),(15,'Reparación de Automóviles','Servicios de reparación y mantenimiento de vehículos','2024-01-15 21:57:45','2024-01-15 21:57:45'),(16,'Asesoría Legal','Asesoramiento legal para individuos y empresas','2024-01-15 21:57:45','2024-01-15 21:57:45'),(17,'Salón de Belleza','Servicios de belleza y cuidado personal','2024-01-15 21:57:45','2024-01-15 21:57:45'),(18,'Agencia Inmobiliaria','Compra, venta y alquiler de propiedades','2024-01-15 21:57:45','2024-01-15 21:57:45'),(19,'Consultoría Ambiental','Asesoría en temas relacionados con el medio ambiente','2024-01-15 21:57:45','2024-01-15 21:57:45'),(20,'Recursos Humanos','Gestión de personal y reclutamiento de talento','2024-01-15 21:57:45','2024-01-15 21:57:45'),(21,'Desarrollo web','Madiffy','2024-01-30 02:38:21','2024-01-30 02:38:21');
/*!40000 ALTER TABLE `specialities` ENABLE KEYS */;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'placeholder.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Juan','Pérez','juanperez@email.com','123456789','2024-01-15 22:03:44','hashed_password_1','placeholder.png','token_1','2024-01-15 22:03:44','2024-01-15 22:03:44'),(2,'Ana','Gómez','anagomez@email.com','987654321','2024-01-15 22:03:44','hashed_password_2','placeholder.png','token_2','2024-01-15 22:03:44','2024-01-15 22:03:44'),(3,'Carlos','López','carloslopez@email.com','555555555','2024-01-15 22:03:44','hashed_password_3','placeholder.png','token_3','2024-01-15 22:03:44','2024-01-15 22:03:44'),(4,'Laura','Martínez','lauramartinez@email.com','333333333','2024-01-15 22:03:44','hashed_password_4','placeholder.png','token_4','2024-01-15 22:03:44','2024-01-15 22:03:44'),(5,'Roberto','Fernández','roberto@email.com','777777777','2024-01-15 22:03:44','hashed_password_5','placeholder.png','token_5','2024-01-15 22:03:44','2024-01-15 22:03:44'),(6,'María','García','mariagarcia@email.com','888888888','2024-01-15 22:03:44','hashed_password_6','placeholder.png','token_6','2024-01-15 22:03:44','2024-01-15 22:03:44'),(7,'Sofía','Hernández','sofiah@email.com','111111111','2024-01-15 22:03:44','hashed_password_7','placeholder.png','token_7','2024-01-15 22:03:44','2024-01-15 22:03:44'),(8,'Diego','Jiménez','diegoj@email.com','999999999','2024-01-15 22:03:44','hashed_password_8','placeholder.png','token_8','2024-01-15 22:03:44','2024-01-15 22:03:44'),(9,'Isabel','Ruiz','isabelr@email.com','444444444','2024-01-15 22:03:44','hashed_password_9','placeholder.png','token_9','2024-01-15 22:03:44','2024-01-15 22:03:44'),(10,'Daniel','Torres','danielt@email.com','666666666','2024-01-15 22:03:44','hashed_password_10','placeholder.png','token_10','2024-01-15 22:03:44','2024-01-15 22:03:44'),(11,'Marta','Díaz','martad@email.com','222222222','2024-01-15 22:03:44','hashed_password_11','placeholder.png','token_11','2024-01-15 22:03:44','2024-01-15 22:03:44'),(12,'Javier','Sánchez','javiers@email.com','555111111','2024-01-15 22:03:44','hashed_password_12','placeholder.png','token_12','2024-01-15 22:03:44','2024-01-15 22:03:44'),(13,'Lucía','Ramírez','luciar@email.com','333444555','2024-01-15 22:03:44','hashed_password_13','placeholder.png','token_13','2024-01-15 22:03:44','2024-01-15 22:03:44'),(14,'Pedro','Herrera','pedroh@email.com','111555555','2024-01-15 22:03:44','hashed_password_14','placeholder.png','token_14','2024-01-15 22:03:44','2024-01-15 22:03:44'),(15,'Carmen','Muñoz','carmenm@email.com','999333111','2024-01-15 22:03:44','hashed_password_15','placeholder.png','token_15','2024-01-15 22:03:44','2024-01-15 22:03:44'),(16,'Ricardo','Vargas','ricardov@email.com','777888555','2024-01-15 22:03:44','hashed_password_16','placeholder.png','token_16','2024-01-15 22:03:44','2024-01-15 22:03:44'),(17,'Elena','Castro','elenac@email.com','888777999','2024-01-15 22:03:44','hashed_password_17','placeholder.png','token_17','2024-01-15 22:03:44','2024-01-15 22:03:44'),(18,'Alejandro','Ortega','alejandroo@email.com','444666888','2024-01-15 22:03:44','hashed_password_18','placeholder.png','token_18','2024-01-15 22:03:44','2024-01-15 22:03:44'),(19,'Luisa','Serrano','luisas@email.com','111222333','2024-01-15 22:03:44','hashed_password_19','placeholder.png','token_19','2024-01-15 22:03:44','2024-01-15 22:03:44'),(20,'Alberto','Molina','albertom@email.com','999444666','2024-01-15 22:03:44','hashed_password_20','placeholder.png','token_20','2024-01-15 22:03:44','2024-01-15 22:03:44'),(23,'Alan','Ortiz','alan@gmail','999444666','2024-02-08 08:44:19','8e87a12aa5285c7a834a6ee717740c07e3db65e4714efb09fbad8e15c689d24d','placeholder.png','token_20','2024-02-08 08:44:19','2024-02-08 08:44:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
