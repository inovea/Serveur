package entities;

import entities.CircuitEntity;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2015-01-24T12:25:19")
@StaticMetamodel(SteedEntity.class)
public class SteedEntity_ { 

    public static volatile SingularAttribute<SteedEntity, String> password;
    public static volatile SingularAttribute<SteedEntity, String> firstname;
    public static volatile SingularAttribute<SteedEntity, String> mail;
    public static volatile SingularAttribute<SteedEntity, String> name;
    public static volatile SingularAttribute<SteedEntity, Long> id;
    public static volatile ListAttribute<SteedEntity, CircuitEntity> circuits;

}