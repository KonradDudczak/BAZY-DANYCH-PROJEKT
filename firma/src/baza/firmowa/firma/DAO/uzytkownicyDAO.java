package baza.firmowa.firma.DAO;
import javax.persistence.EntityManager;
import baza.firmowa.firma.Encje.uzytkownik;

public class uzytkownicyDAO  {
	
	private EntityManager em;
	public uzytkownicyDAO(EntityManager em) {
		this.em = em;
	}
	
	public uzytkownik pobierzLogin(String login) {
		uzytkownik u =  (uzytkownik)em.createQuery("SELECT u FROM uzytkownik u WHERE u.login = :login").
				setParameter("login", login).
				getSingleResult();
		return u;
	}
	
	public boolean dodajuzytkownika (uzytkownik u) {
		u.setHaslo(this.pobierzMD5(u.getHaslo()));

	}
}
