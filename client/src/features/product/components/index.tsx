import { combineUnits } from '../helpers/product';
import { IProductProps } from './interface';

/**
 * Product component.
 *
 * @param {IProductProps} props - Props.
 * @returns {JSX.Element}
 */
const Product = (props: IProductProps): JSX.Element => {
  const { product } = props;
  const { sku, name, price, type, currency, unit, unitValue } = product;

  const combinedUnit = combineUnits(unit, unitValue, type);

  return (
    <div className="product">
      <div className="product-checkbox">
        <input type="checkbox" />
      </div>
      <div className="product__info">
        <div className="product__sku">{sku}</div>
        <div className="product__name">{name}</div>
        <div className="product__price">
          {currency}
          {price}
        </div>
        <div className="product__unit">{combinedUnit}</div>
      </div>
    </div>
  );
};

export default Product;
