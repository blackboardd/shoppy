import { combineUnits } from '../helpers/product';
import { IProductProps, CURRENCY_SYMBOL } from './interface';
import './styles.scss';
import { Currency } from './types';

/**
 * Product component.
 *
 * @param {IProductProps} props - Props.
 * @returns {JSX.Element}
 */
const Product = (props: IProductProps): JSX.Element => {
  const { product, handleClick, handleKeyDown, checked } = props;
  const { sku, name, price, type, currency, unit, unit_value } = product;

  const currencySymbol = CURRENCY_SYMBOL[currency as Currency];
  const combinedUnit = combineUnits(unit, unit_value, type);

  // format price to 2 decimal places
  const formattedPrice = String(Number(price).toFixed(2));

  return (
    <div
      role="checkbox"
      className="product delete-checkbox"
      onClick={handleClick}
      onKeyDown={handleKeyDown}
      tabIndex={0}
      aria-checked={checked}
    >
      <div className="product__info">
        <div className="product__sku">{sku}</div>
        <div className="product__name">{name}</div>
        <div className="product__price">
          {currencySymbol}
          {formattedPrice}
        </div>
        <div className="product__unit">{combinedUnit}</div>
      </div>
      <div className="product-checkbox">
        <input
          className="form-check-input"
          tabIndex={-1}
          disabled
          checked={checked}
          type="checkbox"
          style={{ opacity: 1 }}
        />
      </div>
    </div>
  );
};

export default Product;
