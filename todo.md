# Base de donnees :
1. Creation des tables 
- Produit(id,designation)
- PrixProduit (id,idProduit,prixUniitaire)
- QuantiteProduit(id, idProduit, quantite)
- Caisse (id ,nomDeCaisse)
- User (id, username, mdp)
- Achat (id ,idUser, idCaisse, nomClient, date)
- AchatDetail(id, idAchat, idProduit, quantite)  
