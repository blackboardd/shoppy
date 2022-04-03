import { ITypeSwitcherProps } from './typeSwitcher.interface';

/**
 * Type switcher component.
 *
 * @return {JSX.Element} The type switcher component.
 */
const TypeSwitcher = (props: ITypeSwitcherProps): JSX.Element => {
  const { handlers } = props;

  return (
    <div className="form-group-container type-switcher">
      <div className="form-group">
        <label htmlFor="productType">Product Type</label>
        <select
          onChange={handlers.type}
          className="form-control"
          id="productType"
        >
          <option value="DISC">DVD</option>
          <option value="BOOK">Book</option>
          <option value="FURNITURE">Furniture</option>
        </select>
      </div>
    </div>
  );
};

export default TypeSwitcher;
