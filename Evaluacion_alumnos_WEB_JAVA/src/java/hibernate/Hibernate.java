package hibernate;

import java.util.logging.Level;
import java.util.logging.Logger;
import org.hibernate.HibernateException;
import org.hibernate.SessionFactory;
import org.hibernate.cfg.AnnotationConfiguration;

/**
 *
 * @author marib
 */
public class Hibernate {

    public static SessionFactory sesion = null;

    static {
        try {
            sesion = new AnnotationConfiguration().configure().buildSessionFactory();
        } catch (HibernateException ex) {
            Logger.getLogger(Hibernate.class.getName()).log(Level.SEVERE, null, ex);
            throw new ExceptionInInitializerError(ex);
        } catch (Throwable exe) {
            Logger.getLogger(Hibernate.class.getName()).log(Level.SEVERE, null, exe);
        }
    }

    public static SessionFactory getSesion() {
        return sesion;
    }

}
