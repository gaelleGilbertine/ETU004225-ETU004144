-- Active: 1781678134026@@127.0.0.1@3306
-- Activation des clés étrangères (Recommandé pour SQLite)
PRAGMA foreign_keys = ON;

-- 1. Table User
CREATE TABLE IF NOT EXISTS User (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    mdp TEXT NOT NULL
);

-- 2. Table Caisse
CREATE TABLE IF NOT EXISTS Caisse (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nomDeCaisse TEXT NOT NULL
);

-- 3. Table Produit
CREATE TABLE IF NOT EXISTS Produit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT NOT NULL
);

-- 4. Table PrixProduit
CREATE TABLE IF NOT EXISTS PrixProduit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idProduit INTEGER NOT NULL,
    prixUnitaire REAL NOT NULL,
    FOREIGN KEY (idProduit) REFERENCES Produit(id) ON DELETE CASCADE
);

-- 5. Table QuantiteProduit (Stock)
CREATE TABLE IF NOT EXISTS QuantiteProduit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idProduit INTEGER NOT NULL,
    quantite INTEGER NOT NULL DEFAULT 0,
    FOREIGN KEY (idProduit) REFERENCES Produit(id) ON DELETE CASCADE
);

-- 6. Table Achat
CREATE TABLE IF NOT EXISTS Achat (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER NOT NULL,
    idCaisse INTEGER NOT NULL,
    nomClient TEXT,
    date TEXT NOT NULL DEFAULT (datetime('now', 'localtime')),
    FOREIGN KEY (idUser) REFERENCES User(id),
    FOREIGN KEY (idCaisse) REFERENCES Caisse(id)
);

-- 7. Table AchatDetail
CREATE TABLE IF NOT EXISTS AchatDetail (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idAchat INTEGER NOT NULL,
    idProduit INTEGER NOT NULL,
    quantite INTEGER NOT NULL,
    FOREIGN KEY (idAchat) REFERENCES Achat(id) ON DELETE CASCADE,
    FOREIGN KEY (idProduit) REFERENCES Produit(id)
);