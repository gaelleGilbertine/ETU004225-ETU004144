public class AchatDetailModel {
    private int id;
    private int idAchat;
    private int idProduit;
    private int quantite;

    public AchatDetailModel() {}

    public AchatDetailModel(int id, int idAchat, int idProduit, int quantite) {
        this.id = id;
        this.idAchat = idAchat;
        this.idProduit = idProduit;
        this.quantite = quantite;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getIdAchat() { return idAchat; }
    public void setIdAchat(int idAchat) { this.idAchat = idAchat; }

    public int getIdProduit() { return idProduit; }
    public void setIdProduit(int idProduit) { this.idProduit = idProduit; }

    public int getQuantite() { return quantite; }
    public void setQuantite(int quantite) { this.quantite = quantite; }
}